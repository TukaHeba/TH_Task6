<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Trait\ApiResponseTrait;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
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
        $comments = Comment::with(['post', 'user'])->get();
        return $this->customApi(CommentResource::collection($comments), 'All available comments', 200);
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
    public function store(CommentRequest $request)
    {
        $request->validated();

        $newComments = Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => $request->user_id,
        ]);

        return $this->customApi(new CommentResource($newComments), 'Comment created successfully', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment = Comment::find($id);
        if (!$comment) {
            return $this->errorApi('Comment does not exist', 404);
        }

        return $this->customApi(new CommentResource($comment), 'This is the Comment you want', 200);
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
    public function update(CommentRequest $request, string $id)
    {
        $request->validated();

        $updateComment = Comment::find($id);
        if (!$updateComment) {
            return $this->errorApi('Comment does not exist', 404);
        }
        $updateComment->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);

        return $this->customApi(new CommentResource($updateComment), 'Comment updated successfully', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::find($id);
        
        if (auth()->user()->id !== $comment->user_id) {
            return $this->errorApi('This comment can be deleted only by the publisher', 404);
        } 
        elseif (!$comment || (auth()->user()->id !== $comment->user_id)) {
            return $this->errorApi('Comment does not exist', 404);
        }

        $comment->delete();
        return $this->customApi(new CommentResource($comment), 'Comment deleted successfully', 200);
    }
}
