<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentsResource;
use App\Models\Comment;
use App\Models\Product;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $comments = $product->comments()->with('product')->get();
        return CommentsResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, $product)
    {
        return new CommentsResource(Comment::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return new CommentsResource($comment);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if (auth()->id() !== $comment->user_id) {
        return response()->json(['error' => 'Not your comment'], 403);
        }

        $comment->delete();
        return response()->json([
            'message'=>'Comment was delete'
        ]);
    }
}
