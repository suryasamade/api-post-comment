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
    /**
     * @OA\Get(
     *      path="/api/posts/{postId}/comments",
     *      tags={"Comment"},
     *      summary="Get Comments List of Post",
     *      description="Return list of comments from specific post",
     *      operationId="getCommentsList",
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              items={"$ref":"#/components/schemas/Comment"},
     *          ),
     *          @OA\XmlContent(
     *              type="array",
     *              items={"$ref":"#/components/schemas/Comment"},
     *          )
     *     ),
     *     @OA\Response(response="400", description="Invalid ID"),
     *     @OA\Response(response="404", description="Comments not found"),
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/posts/{postId}/comments/{commentId}",
     *     tags={"Comment"},
     *     summary="Get Comment Details from Specific Post",
     *     description="Return a single comment",
     *     operationId="getCommentById",
     *     @OA\Parameter(
     *          name="postId",
     *          description="Post ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Parameter(
     *          name="commentId",
     *          description="Comment ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Comment",
     *          ),
     *          @OA\XmlContent(
     *              ref="#/components/schemas/Comment",
     *          )
     *     ),
     *     @OA\Response(response="400", description="Invalid ID"),
     *     @OA\Response(response="404", description="Comment not found"),
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/posts/{postId}/comments",
     *     tags={"Comment"},
     *     summary="Add new comment to the post",
     *     description="Create new comment on the post",
     *     operationId="createNewComment",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Comment",
     *          ),
     *          @OA\XmlContent(
     *              ref="#/components/schemas/Comment",
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="postId",
     *          description="Post ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     security={
     *          {"post_auth"={"write:posts", "read:posts"}},
     *          {"api_key"={}}
     *     },
     *     @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Comment",
     *          ),
     *          @OA\XmlContent(
     *              ref="#/components/schemas/Comment",
     *          )
     *     ),
     *     @OA\Response(response="400", description="Invalid input"),
     *     @OA\Response(response="422", description="Validation exception"),
     * )
     */
    public function store(StoreCommentRequest $request, $postId)
    {
        $post = Post::find($postId);

        if (!$post) {
            return response()->json([
                'message' => 'data not found'
            ]);
        }

        $validator = Validator::make($request->validationData(), $request->rules());

        if ($validator->fails()) {
            return response()->json($request->errors(), 422);
        }

        $comment = Comment::create($request->validationData());

        return new CommentResource(true, 'data stored', $comment);
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{postId}/comments/{commentId}",
     *     tags={"Comment"},
     *     summary="Update an existing comment",
     *     description="Update an existing comment by ID from specific post",
     *     operationId="updateComment",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Comment",
     *          ),
     *          @OA\XmlContent(
     *              ref="#/components/schemas/Comment",
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="postId",
     *          description="Post ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Parameter(
     *          name="commentId",
     *          description="Comment ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     security={
     *          {"post_auth"={"write:posts", "read:posts"}}
     *     },
     *     @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Comment",
     *          ),
     *          @OA\XmlContent(
     *              ref="#/components/schemas/Comment",
     *          )
     *     ),
     *     @OA\Response(response="400", description="Invalid input"),
     *     @OA\Response(response="404", description="Comment not found"),
     *     @OA\Response(response="422", description="Validation exception"),
     * )
     */
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

        $validator = Validator::make($request->validationData(), $request->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $comment->message = $request->message;
        $comment->save();

        return new CommentResource(true, 'data updated', $comment);
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{postId}/comments/{commentId}",
     *     tags={"Comment"},
     *     summary="Deletes a comment",
     *     description="Delete a comment by ID from specific post",
     *     operationId="deleteComment",
     *     @OA\Parameter(
     *          name="postId",
     *          description="Post ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *      @OA\Parameter(
     *          name="commentId",
     *          description="Comment ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     security={
     *          {"api_key"={}}
     *     },
     *     @OA\Response(response="200", description="Success deleted"),
     *     @OA\Response(response="400", description="Invalid input"),
     * )
     */
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
