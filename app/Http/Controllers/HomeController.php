<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Auth;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->limit(5)->get();
        $posts = Post::orderBy('id', 'DESC')->where('post_type', 'post')->limit(5)->get();
        // $galleries = Gallery::orderBy('id', 'DESC')->limit(5)->get();
        $users = User::orderBy('id', 'DESC')->limit(5)->get();
        $categoryCount = Category::count();
        $postsCount = Post::count();
        // $galleryCount = Gallery::count();
        $userCount = User::count();
        return view('admin.index', compact('category', 'posts', 'categoryCount', 'postsCount', 'userCount', 'users'));
    }

    public function accounts(){
        $users = User::orderBy('id', 'DESC')->paginate(10);
        return view('auth.index', compact('users'));
    }

    public function accounts_create(){
        return view('auth.users.create');
    }

    public function accounts_edit($account){
        $account = User::find($account);
        return view('auth.users.edit', compact('account'));
    }

    public function accounts_store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()) return redirect()->route('accounts')->with('success-message', 'User Account Created');
        return redirect()->back()->with('error-message', 'Error creating User Account');
    }

    public function accounts_update(Request $request, $account){
        // dd($request->all());
        $this->validate($request, [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,'.$account .',id',
        ]);
        
        $user = User::find($account);
        if(isset($request->name)) $user->name = $request->name;
        if(isset($request->email)) $user->email = $request->email;
        if(isset($request->password)) {
            $this->validate($request, [
                'password' => 'string|min:8|confirmed',
            ]);
            $user->password = Hash::make($request->password);
        }
        if($user->save()) return redirect()->back()->with('success-message', 'User Account Updated');
        return redirect()->back()->with('error-message', 'Error updating User Account');
    }

    public function accounts_destroy($account)
    {
        if (Auth::user()->email !== 'admin@blog.io') return redirect()->back()->with('error-message', Auth::user()->email.' Unauthorizated Action');
        if(auth()->user()->id == $account) return redirect()->back()->with('error-message', 'Cannot Delete LoggedIn Account');
        $user = User::find($account);        
        if($user->delete())return redirect()->route('accounts')->with('success-message', 'User Account deleted');
        else return redirect()->back()->with('error-message', 'Error deleting User Account');
    }
}
