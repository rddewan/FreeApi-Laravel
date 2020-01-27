<?php

namespace App\Http\Controllers\Api\Profile;

use App\Blog\Blog;
use App\Http\Controllers\Controller;
use App\Profile\UserProfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Token;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function index($id)
    {
        ///get post image
        $user_data = User::where('id', '=', $id)->first();
        $post = User::find($user_data->id)->blogs()->pluck('image_path');
        //$image_path = $post->image_path;
        //delete posts image
        foreach ($post as $image ) {
            \File::delete(public_path($image));
        }

        return Response()->json($post,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //base url
        $base_url = env('APP_URL');
        //user profile
        $data = new UserProfile();

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        //set image name
        $user_id = $request->user_id;
        $imageName = $user_id . "." . $request->profile_image->extension();
        //set image location
        $image_dest_path = public_path("/profile_image");
        //move image to given path
        $request->profile_image->move($image_dest_path, $imageName);

        //save data
        $data->user_id = $request->user_id;
        $data->profile_image = $base_url . "/profile_image/" . $imageName;
        $data->profile_image_path = "profile_image/" . $imageName;
        $data->save();

        return response()->json($data, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfileImage(Request $request)
    {
        //base url
        $base_url = env('APP_URL');
        //user profile
        $profile_data = UserProfile::where('user_id', '=', $request->id)->first();

        if ($profile_data) {

            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            //set image name
            $user_id = $request->id;
            $imageName = $user_id . "." . $request->profile_image->extension();
            //set image location
            $image_dest_path = public_path("/profile_image");
            //move image to given path
            $request->profile_image->move($image_dest_path, $imageName);

            //save profile data
            $profile_data->profile_image = $base_url . "/profile_image/" . $imageName;
            $profile_data->profile_image_path = "profile_image/" . $imageName;
            $profile_data->save();

            return response()->json($profile_data, Response::HTTP_CREATED);
        }

        return response()->json("Sorry user does not exist", 404);
    }

    public function updateUserPassword(Request $request)
    {
        $validateData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'token_id' => 'required'

        ]);


        $hash_password = User::where('id', '=', $request->id)->value('password');

        if (Hash::check($request->old_password, $hash_password)) {

            //update password
            $user_data = User::where('id', '=', $request->id)->first();
            $user_data->password = bcrypt($request->password);
            $user_data->save();


            //revoke access token
            Token::where('user_id', $request->id)
                ->where('id', $request->token_id)
                ->update(['revoked' => true]);

            //delete record from oauth_access_tokens after revoke
            Token::where('user_id', $request->id)
                ->where('id', $request->token_id)
                ->delete();

            return response()->json([
                'success' => 'Your password has been successfully updated. please logout and login.'
            ], Response::HTTP_CREATED);
        }
        return response()->json([
            'error' => 'Your old password does not match. Please enter a correct password.'
        ], Response::HTTP_NOT_FOUND);

    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required',
            'password' => 'required'

        ]);


        $hash_password = User::where('id', '=', $request->id)->value('password');

        if (Hash::check($request->password, $hash_password)) {

            //get user data
            $user_data = User::where('id', '=', $request->id)->first();
            //get the list of post image
            $post_image = User::find($user_data->id)->blogs()->pluck('image_path');

            if ($user_data) {

                //delete record from oauth_access_tokens after revoke
                Token::where('user_id', $request->id)
                    ->where('id', $request->token_id)
                    ->delete();

                //delete posts image
                foreach ($post_image as $image ) {
                    \File::delete(public_path($image));
                }

                //delete posts belongs to user
                $user_data->blogs()->delete();


                //delete profile
                $profile_data = UserProfile::where('user_id', '=', $request->id)->first();
                $profile_image = $profile_data->profile_image_path;
                $profile_data->delete();

                //delete profile image
                \File::delete(public_path($profile_image));

                //finally delete user
                $user_data->delete();

                return response()->json([
                    'success' => 'Your account has been successfully deleted.'
                ], Response::HTTP_CREATED);
            }

        }
        return response()->json([
            'error' => 'Your old password does not match. Please enter your correct password.'], Response::HTTP_NOT_FOUND);

    }
}
