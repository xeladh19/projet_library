<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PostController extends Controller
{
        public function index(){
            return response()->json(Post::all()); 
        }
        public function show($id){
            return response()->json(Post::find($id));
        }
        public function store(Request $request){
            $post = Post::create($request->all());
            return response()->json($post);
        }
        public function update(Request $request, $id){
            $post = Post::find($id);
            $post->update($request->all());
            return response()->json($post);
        }
        public function destroy($id){
            $post = Post::find($id);
            $post->delete();
            return response()->json('deleted');
        }
}
