<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Storage;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('name', 'DESC')->pluck('name', 'id');
        return view('admin.posts.create', compact('category'));
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
            'thumbnail' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'details' => 'required',
            'title' => 'required|unique:posts',
        ],
        [
            'title.required' => 'Enter title',
            'title.unique' => 'post with same title already exist',
            'details.required' => 'Enter post details',
        ]);
        $fileName = time().'.'.$request->thumbnail->extension();  
        $thumbnail = $request->file('thumbnail')->storeAs(
            'posts', $fileName, 'public'
        );
        $post = new Post();
        $post->thumbnail = $thumbnail;
        $post->title = $request->title;
        $post->sub_title = $request->sub_title;
        $post->details = $request->details;
        $post->slug = \str_slug($request->title);
        $post->is_published = $request->is_published;
        $post->user_id = auth()->user()->id;
        $post->post_type = 'post';
        if($post->save()){
            $post->categories()->sync($request->category_id, false);
            $message = 'post added successfully';
            return redirect()->route('posts.index')->with('success-message', $message);
        }
        $message = 'Error adding post';
        return redirect()->back()->with('error-message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        $post = Post::find($post);
        if($post){
            $category = Category::orderBy('name', 'DESC')->pluck('name', 'id');
            return view('admin.posts.create', compact('category'));
        }
        return redirect()->back()->with('error-message', 'Error fetch request data');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        $post = Post::find($post);
        if($post){
            $category = Category::orderBy('name', 'DESC')->pluck('name', 'id');
            return view('admin.posts.edit', compact('category', 'post'));
        }
        return redirect()->back()->with('error-message', 'Error fetch request data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        $this->validate($request, [
            'thumbnail' => 'file|mimes:jpg,jpeg,png|max:2048',
            'details' => 'required',
            'title' => 'required|unique:posts,title,'.$post .',id', //ignore this id
        ],
        [
            'title.required' => 'Enter title',
            'title.unique' => 'post with same title already exist',
            'details.required' => 'Enter post details',
        ]);
                
        $post = Post::find($post);
        $filePath = $post->thumbnail;
        if($request->has('thumbnail')){
            $fileName = time().'.'.$request->thumbnail->extension();  
            $filePath = $request->file('thumbnail')->storeAs(
                'post', $fileName, 'public'
            );      
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->thumbnail = $filePath;
        $post->title = $request->title;
        $post->sub_title = $request->sub_title;
        $post->details = $request->details;
        $post->slug = \str_slug($request->title);
        $post->is_published = $request->is_published;
        $post->user_id = auth()->user()->id;
        $post->post_type = 'post';
        if($post->save()){
            if($request->has('category_id')) $post->categories()->sync($request->category_id);
            $message = 'post updated successfully';
            return redirect()->route('posts.index')->with('success-message', $message);
        }
        $message = 'Error updating post';
        return redirect()->back()->with('error-message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        if (Auth::user()->email !== 'admin@blog.io') return redirect()->back()->with('error-message', 'Unauthorizated Action');
        $post = Post::find($post);
        
        if($post->delete()) {            
            if($post->thumbnail) Storage::disk('public')->delete($post->thumbnail);
            return redirect()->route('posts.index')->with('success-message', 'post record deleted');
        }
        else return redirect()->back()->with('error-message', 'Error deleting post record');
    }
    
    public function upload_image_cke(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
    
            // $request->file('upload')->move(public_path('media'), $fileName);
            $request->file('upload')->storeAs(
                'posts', $fileName, 'public'
            );
    
            // $url = asset('media/' . $fileName);
            $url = asset('storage/posts/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);  
        }
    }
}
