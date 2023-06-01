<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
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
        if($roles ==[])
            return redirect()->route('welcome', app()->getLocale());

        if (in_array("SuperAdmin", $roles) || in_array("Admin", $roles) || in_array("Manager", $roles) || in_array("Accountant", $roles) ) {
            $new_users = User::orderBy('id', 'desc')->with('profile')->limit(6)->get();
            $new_books = Book::active()->orderBy('id', 'desc')->with('BooksType')->with('BooksType.translations')->limit(3)->get();
            $new_orders = Order::active()->orderBy('id', 'desc')->limit(5)->get();
            return view('home', compact('new_users', 'new_books', 'new_orders'));
        } elseif (in_array("Author", $roles)) {
            return app()->getLocale() . '/admin/sisauthor';
        } elseif (in_array("Reader", $roles)) {
            return view('reader.dashboard');
        }elseif (in_array("User", $roles)) {
            return view('reader.dashboard');
        }



    }
}
