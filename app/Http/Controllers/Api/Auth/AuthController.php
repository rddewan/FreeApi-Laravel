<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Profile\UserProfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /*
     * register user
     */
    public function register(Request $request){

        //base url
        $base_url = env('APP_URL');

        $validateData = $request->validate([
            'name'=>'required|max:25',
            'email'=>'email|required|unique:users',
            'password'=> 'required|confirmed'

        ]);

        //create user
        $user = new User(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]
        );

        $user->save();

        //create user profile
        if ($user){

            $profile = new UserProfile();
            $profile->user_id = $user->id;
            $profile->profile_image = $base_url.'/profile_image/default_profile.png';
            $profile->profile_image_path = 'profile_image/default_profile.png';
            $profile->save();
        }

        return response()->json($user,201);


    }

    /*
     * login user
     */
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)){

            return response()->json([
                'error' => 'Unauthorised Access. Please check your login detail'], 401);

        }

        $user = $request->user();

        $tokenResult = $user->createToken('AccessToken');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addMinutes(60);
        $token->save();

        return response()->json([
            'access_token' => "Bearer ".$tokenResult->accessToken,
            'token_id' => $token->id,
            'token_type' => 'Bearer',
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ]);


    }

    /*
     *
     * get user detail
     */

    public function userDetail($id){

        $data = DB::table('users')
            ->where('users.id','=',$id)
            ->join('user_profiles','users.id','=','user_profiles.user_id')
            ->select('users.id',
                'users.name',
                'users.email',
                'users.email_verified_at',
                'user_profiles.profile_image')
            ->get();

        return response()->json($data,200);
    }
}
