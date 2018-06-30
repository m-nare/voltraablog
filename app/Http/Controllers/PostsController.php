<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Comments;
use App\Category;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
		return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('posts.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'post_image' => 'image|nullable|max:1999',
            'category_id' => 'required'
        ]);

        // handle File Upload
	    if($request->hasFile('post_image'))
	    {
		    // Get filename with the extension
            $filenameWithExt = $request->file('post_image')->getClientOriginalName();
            
		    // Get just filename 
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            	
		    // Get just extension
            $extension = $request->file('post_image')->getClientOriginalExtension();
            
		    // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
		    // Upload image
		    $path = $request->file('post_image')->storeAs('public/post_images', $fileNameToStore);
        }
	    else
	    {
		    $fileNameToStore = 'noimage.png';
	    }

        // create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->post_image = $fileNameToStore;
        $post->category_id = $request->input('category_id');
        $post->save();    

        return redirect('/posts')->with('success', 'Post created');
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
        $categories = Category::orderBy('name', 'asc')->get();

        // check for correct user
	    if(auth()->user()->id !== $post->user_id){
		    return redirect('/posts')->with('error', 'Unauthorized Page');
	    }

        return view('posts.edit')->with(['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'post_image' => 'image|nullable|max:1999',
            'category_id' => 'required'
        ]);

        // handle File Upload
	    if($request->hasFile('post_image'))
	    {
		    // Get filename with the extension
            $filenameWithExt = $request->file('post_image')->getClientOriginalName();
            
		    // Get just filename 
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            	
		    // Get just extension
            $extension = $request->file('post_image')->getClientOriginalExtension();
            
		    // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
		    // Upload image
		    $path = $request->file('post_image')->storeAs('public/post_images', $fileNameToStore);
	    }

        // update post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('post_image')){
            $post->post_image  = $fileNameToStore;
        }
        $post->category_id = $request->input('category_id');
        $post->save(); 

        return redirect('/posts')->with('success', 'Post updated');
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

        // check for correct user
	    if(auth()->user()->id !== $post->user_id){
		    return redirect('/posts')->with('error', 'Unauthorized Page');
	    }

        if($post->post_image != 'noimage.png'){
            Storage::delete('public/post_images/'.$post->post_image);
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post deleted');
    }
}
