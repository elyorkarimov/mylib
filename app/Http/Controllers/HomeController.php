<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $roles = Auth::user()->getRoleNames()->toArray();
        if (in_array("SuperAdmin", $roles) || in_array("Admin", $roles) || in_array("Manager", $roles)) {
            $new_users = User::orderBy('id', 'desc')->limit(6)->get();
            $new_books = Book::active()->orderBy('id', 'desc')->limit(3)->get();
            return view('home', compact('new_users', 'new_books'));    
        } elseif (in_array("Author", $roles)) {
            return app()->getLocale() . '/admin/sisauthor';
        } elseif (in_array("Reader", $roles)) {
            return view('reader.dashboard');
        }elseif (in_array("User", $roles)) {
            return view('reader.dashboard');
        }



    }
}
