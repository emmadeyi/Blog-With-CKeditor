<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Storage;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categories::orderBy('id', 'DESC')->get();
        return view('admin.categories.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        return view('admin.categories.create');
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
            'name' => 'required|unique:categories',
        ],
        [
            'thumbnail.required' => 'Enter thumbnail url',
            'name.required' => 'Enter name',
            'name.unique' => 'Category Item with same name already exist',
        ]);
        $fileName = time().'.'.$request->thumbnail->extension();  
        $thumbnail = $request->file('thumbnail')->storeAs(
            'categories', $fileName, 'public'
        );
        $category = new Categories();
        $category->thumbnail = $thumbnail;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = \str_slug($request->name);
        $category->is_published = $request->is_published;
        $category->user_id = auth()->user()->id;
        if($category->save()){
            $message = 'Category Item added successfully';
            return redirect()->route('categories.index')->with('success-message', $message);
        }
        $message = 'Error adding Category Item';
        return redirect()->back()->with('error-message', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $category = Categories::find($category);
        if($category) return view('admin.categories.edit', compact('category'));
        else return redirect()->back()->with('error-message', 'Error fetch request data');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $category)
    {
        $this->validate($request, [
            'thumbnail' => 'file|mimes:jpg,jpeg,png|max:2048',
            'name' => 'required|unique:categories,name,'.$category,
        ],
        [
            'name.required' => 'Enter name',
            'name.unique' => 'Category Item with same name already exist',
        ]);

        $category = Categories::find($category);
        $filePath = $category->thumbnail;
        if($request->has('thumbnail')){
            $fileName = time().'.'.$request->thumbnail->extension();  
            $filePath = $request->file('thumbnail')->storeAs(
                'categories', $fileName, 'public'
            );      
            Storage::disk('public')->delete($category->thumbnail);
        }
        $category->thumbnail = $filePath;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = \str_slug($request->name);
        $category->is_published = $request->is_published;
        $category->user_id = auth()->user()->id;
        if($category->save()){
            $message = 'Category Item updated successfully';
            return redirect()->back()->with('success-message', $message);
        }
        $message = 'Error updating Category Item';
        return redirect()->back()->with('error-message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        if (Auth::user()->email !== 'admin@blog.io') return redirect()->back()->with('error-message', 'Unauthorizated Action');
        $category = Categories::find($category);
        if($category->delete()) {                  
            if($category->thumbnail) Storage::disk('public')->delete($category->thumbnail);
            return redirect()->route('categories.index')->with('success-message', 'Category item deleted');
        }
        else return redirect()->back()->with('error-message', 'Error deleting Category Item');
    }
}
