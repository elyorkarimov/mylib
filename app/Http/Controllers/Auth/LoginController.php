<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectTo()
    {
        $roles = Auth::user()->getRoleNames()->toArray();

        if (in_array("SuperAdmin", $roles) || in_array("Admin", $roles) || in_array("Manager", $roles)) {
            return app()->getLocale() . '/home';
        } elseif (in_array("Author", $roles)) {
            return app()->getLocale() . '/admin/sisauthor';
        } elseif (in_array("Reader", $roles)) {
            return app()->getLocale() . '/admin/reader';
        }elseif (in_array("User", $roles)) {
            return app()->getLocale() . '/admin/usreader';
        }
        // return app()->getLocale() . '/home';
    }
}
