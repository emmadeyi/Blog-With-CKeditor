<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::orderBy('id', 'DESC')->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $posts = Post::orderBy('title', 'ASC')->pluck('title', 'id');
        return view('admin.galleries.create', compact('category', 'posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);
            
        $fileName = time().'.'.$request->image->extension();  
        $filePath = $request->file('image')->storeAs(
            'gallery', $fileName, 'public'
        );

        /* Store $fileName name in DATABASE from HERE */
        $gallery = new Gallery;
        $gallery->user_id = auth()->user()->id;
        $gallery->image_url = $filePath;
        if($gallery->save()){
            if($request->has('fleet_id')) {
                $gallery->categorys()->sync($request->fleet_id);
            }
            if($request->has('post_id')) {
                $gallery->posts()->sync($request->post_id);
            }
            $message = 'Gallery image added successfully';
            return redirect()->route('galleries.index')->with('success-message', $message);
        }
        $message = 'Error adding gallery image';
        return redirect()->back()->with('error-message', $message);    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($gallery)
    {
        $gallery = Gallery::find($gallery);
        $category = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $posts = Post::orderBy('title', 'ASC')->pluck('title', 'id');
        return view('admin.galleries.edit', compact('gallery', 'category', 'posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gallery)
    {      
        $request->validate([
            'image' => 'file|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        /* Store $fileName name in DATABASE from HERE */
        $gallery = Gallery::find($gallery);
        $filePath = $gallery->image_url;
        if($request->has('image')){
            $fileName = time().'.'.$request->image->extension();  
            $filePath = $request->file('image')->storeAs(
                'gallery', $fileName, 'public'
            );      
            Storage::disk('public')->delete($gallery->image_url);
        }
        $gallery->user_id = auth()->user()->id;            
        $gallery->image_url = $filePath;
        if($gallery->save()){
            if($request->has('fleet_id')) {
                $gallery->categorys()->sync($request->fleet_id);
            }
            if($request->has('post_id')) {
                $gallery->posts()->sync($request->post_id);
            }
            $message = 'Gallery image added successfully';
            return redirect()->back()->with('success-message', $message);
        }
        $message = 'Error adding gallery image';
        return redirect()->back()->with('error-message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($gallery)
    {
        $gallery = Gallery::find($gallery);
        if($gallery->delete()) {
            Storage::disk('public')->delete($gallery->image_url);
            return redirect()->route('galleries.index')->with('success-message', 'Gallery record deleted');
        }
        else return redirect()->back()->with('error-message', 'Error deleting Gallery record');
    }
}
