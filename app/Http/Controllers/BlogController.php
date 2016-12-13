<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostFormRequest;
use Session;

class BlogController extends Controller
{
	public function getSingle($slug){
		$post = Post::where('slug', '=', $slug)->first();

		return view('blog.single')->withPost($post);
	}
	
	public function getIndex(){
		$posts = post::paginate(4);
		return view('blog.index')->withPosts($posts);
	}
}