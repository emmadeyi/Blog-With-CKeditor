<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Categories;
use App\Models\Post;
use Response;
use Auth;

class WebsiteController extends Controller
{
    private $dataPerPage = 10;
    private $isPublished = '1';
    private $dataOrder = 'DESC';
    // private $navtags = Categories::has('posts')->get();

    public function index(){
        $categories = Categories::orderBy('name', $this->dataOrder)->where('is_published', $this->isPublished)->limit(6)->get();
        $posts = Post::orderBy('id', $this->dataOrder)->where('post_type', 'post')->where('is_published', $this->isPublished)->limit(6)->get();
        $navtags = Categories::has('posts')->get();
        return view('website.index', compact('categories', 'posts', 'navtags'));
    }

    public function service_details($slug){
        return view('website.service_details');
    }

    public function categories(){
        $categories = Categories::orderBy('id', $this->dataOrder)->where('is_published', $this->isPublished)->paginate($this->dataPerPage);
        $categoryCount = Categories::orderBy('id', $this->dataOrder)->where('is_published', $this->isPublished)->count();
        $navtags = Categories::has('posts')->get();
        return view('website.categories', compact('categories', 'categoryCount', 'navtags'));
    }
    
    public function posts(){
        $posts = Post::orderBy('id', $this->dataOrder)->where('post_type', 'post')->where('is_published', $this->isPublished)->paginate($this->dataPerPage);
        $postCount = Post::orderBy('id', $this->dataOrder)->where('post_type', 'post')->where('is_published', $this->isPublished)->count();
        $categories = Categories::orderBy('name', $this->dataOrder)->where('is_published', $this->isPublished)->limit(6)->get();
        $navtags = Categories::has('posts')->get();
        if($postCount > 0) return view('website.posts', compact('posts', 'postCount', 'categories', 'navtags'));
        else return Response::view('website.error.404', array(), 404);
    }

    public function postDetails($slug){
        $post = Post::where('slug', $slug)->where('post_type', 'post')->where('is_published', $this->isPublished)->first();
        $posts = Post::orderBy('id', $this->dataOrder)->where('post_type', 'post')->where('is_published', $this->isPublished)->limit(5)->get();
        $categories = Categories::orderBy('id', $this->dataOrder)->where('is_published', $this->isPublished)->get();
        $navtags = Categories::has('posts')->get();
        if($post){
            return view('website.post', compact('post', 'posts', 'categories', 'navtags'));
        } 
        else {
            return Response::view('website.error.404', array(), 404);
        }
    }

    public function categoryDetails($slug){
        $category = Categories::where('slug', $slug)->where('is_published', $this->isPublished)->first();
        // $posts = Post::orderBy('id', $this->dataOrder)->where('post_type', 'post')->where('is_published', $this->isPublished)->limit(5)->get();
        $categories = Categories::orderBy('id', $this->dataOrder)->where('is_published', $this->isPublished)->get();
        $navtags = Categories::has('posts')->get();
        if($category){
            $category_posts = $category->posts()->orderBy('posts.id', $this->dataOrder)->where('is_published', $this->isPublished)->paginate($this->dataPerPage);
            return view('website.category-posts', compact('category', 'category_posts', 'categories', 'navtags'));
        } 
        else {
            return Response::view('website.error.404', array(), 404);
        }
    }
}
