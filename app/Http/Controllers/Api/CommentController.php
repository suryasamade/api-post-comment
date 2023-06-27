<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function index($postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $comments = $post->comments;

        return new CommentResource(true, 'success', $comments);
    }

    public function show($postId, $commentId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $comments = $post->comments;
        $comment = $comments->find($commentId);

        if (!$comment) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        return new CommentResource(true, 'success', $comment);
    }

    public function store(StoreCommentRequest $request, $postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json([
                'message' => 'data not found'
            ]);
        }

        /* $request->request->add(['post_id' => intval($postId)]);

        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'post_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } */

        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        $comment = Comment::create($request->all());

        return new CommentResource(true, 'data stored', $comment);
    }

    public function update(UpdateCommentRequest $request, $postId, $commentId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json([
                'message' => 'data not found'
            ]);
        }

        $comments = $post->comments;
        $comment = $comments->find($commentId);

        if (!$comment) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $request->request->add(['post_id' => intval($postId)]);

        /* $validator = Validator::make($request->all(), [
            'message' => 'required',
            'post_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } */

        if ($request->fails()) {
            return response()->json($request->errors(), 422);
        }

        $comment->message = $request->message;
        $comment->save();

        return new CommentResource(true, 'data updated', $comment);
    }

    public function destroy($postId, $commentId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json([
                'message' => 'data not found'
            ]);
        }

        $comments = $post->comments;
        $comment = $comments->find($commentId);

        if (!$comment) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $comment->delete();

        return new CommentResource(true, 'data deleted', '');
    }
}
