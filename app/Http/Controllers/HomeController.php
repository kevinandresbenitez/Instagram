<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*Impor model Publication*/
use App\Models\Publication;

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
    public function index(){
        $publications =Publication::all();
        return view('home',['publications'=>$publications]);
    }
}
