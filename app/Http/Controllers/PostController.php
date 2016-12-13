<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Category;
use App\Tag;
use Purifier;
use Image;
use Storage;

function slugify($a)
{
	// replace non letter or digits by -
	$a = preg_replace('~[^\pL\d]+~u', '-', $a);

	// transliterate
	$a = iconv('utf-8', 'us-ascii//TRANSLIT', $a);

	// remove unwanted characters
	$a = preg_replace('~[^-\w]+~', '', $a);

	// trim
	$a = trim($a, '-');

	// remove duplicate -
	$a = preg_replace('~-+~', '-', $a);

	if (empty($a)) {
		return 'n-a';
	}
	return $a;
}
class PostController extends Controller
{
		public function __construct()
    {
        $this->middleware('nadiacan');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$posts = Post::orderBy('updated_at', 'desc')->paginate(5);
			return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
				$categories = Category::all();
				$tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
			$post = new Post;
			
			$post->title = ucwords($request->titleform);
			$post->slug = slugify($request->titleform);
			$post->category_id = $request->category_idform;
			$post->body = $request->bodyform;
			
			if($request->hasFile('featured_image')){
				$image = $request->file('featured_image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$location = public_path('images/' . $filename);
				Image::make($image)->resize(800, 400)->save($location);
				
				$post->image = $filename;
			}
			
			$post->save();
			
			$post->tags()->sync($request->tags);
			
			Session::flash('success','The blog post was successfully saved!');
			
			return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
				$post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::find($id);
			$categories = Category::all();
			$tags = Tag::all();
			return view('posts.edit')->withPost($post)->withTags($tags)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, $id)
    {
			$post = Post::find($id);
			
			$post->title = ucwords($request->titleform);
			$post->slug = slugify($request->titleform);
			$post->category_id = $request->category_idform;
			$post->body = $request->bodyform;
			
			if($request->hasFile('featured_image')){
				$image = $request->file('featured_image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$location = public_path('images/' . $filename);
				Image::make($image)->resize(800, 400)->save($location);
				$oldFilename = $post->image;
				
				$post->image = $filename;
				
				Storage::delete($oldFilename);
			}
			
			$post->save();
			
			if(isset($request->tags)){
				$post->tags()->sync($request->tags);	
			} else {
				$post->tags()->sync(array());
			}
			
			Session::flash('success','The blog post was successfully updated!');
			
			return redirect()->route('posts.show', $post->id);      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
			$post->tags()->detach();
			$post->delete();
			Session::flash('success', 'The post is deleted!');
			return redirect()->route('posts.index');
    }
}
