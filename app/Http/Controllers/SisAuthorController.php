<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SisAuthorController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::user()->id;

        $perPage = 20;
        // $debtors = Debtor::whereNull('qaytargan_vaqti')->groupBy('kitobxon_id')->orderBy('qaytarish_vaqti', 'asc')->paginate();
 
        // dd($debtors);groupBy('reader_id')->
        return view('sisauthor.index');
    }
}
