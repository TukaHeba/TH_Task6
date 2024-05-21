<?php

namespace App\Http\Controllers\Api;

use App\Http\Trait\ApiResponseTrait;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    use ApiResponseTrait;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['category', 'user'])->get();
        return $this->customApi(PostResource::collection($posts), 'All available posts', 200);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request->validated();

        $newPost = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);

        return $this->customApi(new PostResource($newPost), 'Post created successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->errorApi('Post does not exist', 404);
        }

        return $this->customApi(new PostResource($post), 'This is the Post you want', 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, string $id)
    {
        $request->validated();

        $updatePost = Post::find($id);
        if (!$updatePost) {
            return $this->errorApi('Post does not exist', 404);
        }
        $updatePost->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);

        return $this->customApi(new PostResource($updatePost), 'Post updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if (auth()->user()->id !== $post->user_id) {
            return $this->errorApi('This post can be deleted only by the publisher', 404);
        } 
        elseif (!$post) {
            return $this->errorApi('Post does not exist', 404);
        }

        $post->delete();
        return $this->customApi(new PostResource($post), 'Post deleted successfully', 200);
    }
}
