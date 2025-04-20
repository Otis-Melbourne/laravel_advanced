<?php

namespace App\Http\Controllers;

use App\Events\PostCreationEvent;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Cache::remember('posts', 10, function(){
            return Post::get();
        } );

        return response()->json([
            'statusCode' => 200,
            'data' => [
                'posts' => PostResource::collection($posts),
            ]
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|string|max:255|unique:posts,name",
        ]);


        if($validator->fails()){
            return response()->json([
                'statusCode' => 400,
                'message' => $validator->errors(),
            ], 400);
        }

        $post = Post::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);

        PostCreationEvent::dispatch($post);
        
        return response()->json([
            'statusCode' => 201,
            'data' => [
                'post' => new PostResource($post),
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
            return response()->json([
                'statusCode' => 200,
                'data' => [
                    'post' => new PostResource($post),
                ]
            ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        Gate::authorize('update', $post);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:posts,name,'.$post->id,
        ]);

        if($validator->fails()){
            return response()->json([
                'statusCode' => 400,
                'message' => $validator->errors(),
            ], 400);
        }

        $post->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'statusCode' => 200,
            'message' => "post updated successfully",
            'data' => [
                'post' => new PostResource($post),
            ],
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        Gate::authorize('delete', $post);
        $post->delete();
        return response()->json([
            'statusCode' => 200,
            'message' => "post deleted successfully",
        ], 200 );
    }
}
