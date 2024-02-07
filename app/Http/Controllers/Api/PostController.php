<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/posts",
     *      tags={"Post"},
     *      summary="Get List of Post",
     *      description="Return list of posts",
     *      operationId="getPostsList",
     *      @OA\Response(
     *          response="200",
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              items={"$ref":"#/components/schemas/Post"},
     *          ),
     *          @OA\XmlContent(
     *              type="array",
     *              items={"$ref":"#/components/schemas/Post"},
     *          )
     *     ),
     *     @OA\Response(response="400", description="Invalid ID"),
     *     @OA\Response(response="404", description="Post not found"),
     * )
     */
    public function index()
    {
        $posts = Post::all();

        if (!$posts) {
            return response()->json([
                'message' => 'no content'
            ], 204);
        }

        return new PostResource(true, 'success', $posts);
    }

    /**
     * @OA\Get(
     *     path="/api/posts/{id}",
     *     tags={"Post"},
     *     summary="Get Post Details",
     *     description="Return a single post",
     *     operationId="getPostById",
     *     @OA\Parameter(
     *          name="id",
     *          description="Post ID",
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
     *              ref="#/components/schemas/Post",
     *          ),
     *          @OA\XmlContent(
     *              ref="#/components/schemas/Post",
     *          )
     *     ),
     *     @OA\Response(response="400", description="Invalid ID"),
     *     @OA\Response(response="404", description="Post not found"),
     * )
     */
    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        return new PostResource(true, 'success', $post);
    }

    /**
     * @OA\Post(
     *     path="/api/posts",
     *     tags={"Post"},
     *     summary="Add new post",
     *     description="Create new post",
     *     operationId="createNewPost",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Post",
     *          ),
     *          @OA\XmlContent(
     *              ref="#/components/schemas/Post",
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
     *              ref="#/components/schemas/Post",
     *          ),
     *          @OA\XmlContent(
     *              ref="#/components/schemas/Post",
     *          )
     *     ),
     *     @OA\Response(response="400", description="Invalid input"),
     *     @OA\Response(response="422", description="Validation exception"),
     * )
     */
    public function store(StorePostRequest $request)
    {
        if (!$request->validated()) {
            return response()->json($request->errors(), 422);
        }

        $post = Post::create($request->all());

        return new PostResource(true, 'data stored', $post);
    }

    /**
     * @OA\Put(
     *     path="/api/posts/{id}",
     *     tags={"Post"},
     *     summary="Update an existing post",
     *     description="Update an existing post by ID",
     *     operationId="updatePost",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              ref="#/components/schemas/Post",
     *          ),
     *          @OA\XmlContent(
     *              ref="#/components/schemas/Post",
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="id",
     *          description="Post ID",
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
     *              ref="#/components/schemas/Post",
     *          ),
     *          @OA\XmlContent(
     *              ref="#/components/schemas/Post",
     *          )
     *     ),
     *     @OA\Response(response="400", description="Invalid input"),
     *     @OA\Response(response="404", description="Post not found"),
     *     @OA\Response(response="422", description="Validation exception"),
     * )
     */
    public function update(UpdatePostRequest $request, $id)
    {
        if (!$request->validated()) {
            return response()->json($request->errors(), 422);
        }

        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $post->title = $request->title;
        $post->text = $request->text;
        $post->save();

        return new PostResource(true, 'data updated', $request->all());
    }

    /**
     * @OA\Delete(
     *     path="/api/posts/{id}",
     *     tags={"Post"},
     *     summary="Deletes a post",
     *     description="Delete a post by ID",
     *     operationId="deletePost",
     *     @OA\Parameter(
     *          name="id",
     *          description="Post ID",
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
    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $post->delete();

        return new PostResource(true, 'data deleted', '');
    }
}
