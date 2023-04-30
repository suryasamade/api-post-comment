<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:10|max:100',
            'text' => 'required|min:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = Post::create($request->all());

        return new PostResource(true, 'data stored', $post);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:10|max:100',
            'text' => 'required|min:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
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
