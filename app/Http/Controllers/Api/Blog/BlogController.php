<?php

namespace App\Http\Controllers\Api\Blog;

use App\Blog\Blog;
use App\Http\Controllers\Controller;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('blogs')
            ->join('users','blogs.user_id','=','users.id')
            ->leftJoin('user_profiles','users.id','=','user_profiles.user_id')
            ->select('blogs.*','users.name','user_profiles.profile_image')
            ->orderBy('blogs.id','desc')
            ->get();

        return response()->json($data,200);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //base url
        $base_url = env('APP_URL');
        /*
         * if image is empty
         */
        if ($request->image == ""){

            $data = new Blog();
            $data->user_id = $request->user_id;
            $data->title = $request->title;
            $data->body = $request->body;
            $data->save();

            return  response()->json($data,201);

        }

        $request->validate([
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        //set image name
        $imageName = $request->user_id."_".time().".".$request->image->extension();
        //set image location
        $image_dest_path = public_path("/post_image");
        //move image to given path
        $request->image->move($image_dest_path, $imageName);

        $data = new Blog();
        $data->user_id = $request->user_id;
        $data->title = $request->title;
        $data->body = $request->body;
        $data->image = $base_url."/post_image/".$imageName;
        $data->image_path = "post_image/".$imageName;
        $data->save();

        return  response()->json($data,201);


    }

    public function storeImage(Request $request)
    {
        $request->validate([
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        //set image name
        $user_id = $request->user_id;
        $imageName = $user_id."_".time().".".$request->image->extension();
        //set image location
        $image_dest_path = public_path("/post_image");
        //move image to given path
        $request->image->move($image_dest_path, $imageName);

        return  response()->json($request,200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        //base url
        $base_url = env('APP_URL');
        /*
         * if image is empty
         */
        if ($request->image == ""){

            $data = Blog::where('id','=',$request->id)->first();
            $data->user_id = $request->user_id;
            $data->title = $request->title;
            $data->body = $request->body;
            $data->image = null;
            $data->save();

            return  response()->json($data,201);

        }

        $request->validate([
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        //set image name
        $imageName = $request->user_id."_".time().".".$request->image->extension();
        //set image location
        $image_dest_path = public_path("/post_image");
        //move image to given path
        $request->image->move($image_dest_path, $imageName);

        $data = $data = Blog::where('id','=',$request->id)->first();;
        $data->user_id = $request->user_id;
        $data->title = $request->title;
        $data->body = $request->body;
        $data->image = $base_url."/post_image/".$imageName;
        $data->image_path = "post_image/".$imageName;
        $data->save();

        return  response()->json($data,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $data = Blog::where('id','=',$id)->first();

        if (!empty($data)){

            $data->delete();

            if ($data) {
                return response()->json(['message' => 'Post deleted successfully'], 200);
            } else {
                return response()->json(['message' => 'There was a error.Please try again.'], 401);
            }
        }

        return response()->json(['message' => 'Record does not exist'], 404);


    }
}
