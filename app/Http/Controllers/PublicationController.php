<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/*Impor model Publication*/
use App\Models\Publication;


class PublicationController extends Controller{

  public function __construct(){
    $this->middleware('auth');
  }

  public function show(Request $request){
    $publications =Publication::all()->where('user_id',Auth::user()->id);
    return view('publications.show',['publications'=>$publications]);
  }

  public function create(Request $request){
    return view('publications.create');
  }

  public function save(Request $request){

    $this->validate($request ,[
        'img' =>['required','image','mimes:png,jpge,jpg,gif','max:1000'],
    ]);


    /*Create publication*/
    $publication = new Publication();
    $publication->img ='In process';
    $publication->user_id =Auth::user()->id;
    $publication->description =$request->description;
    $publication->save();

    /*insert publication image*/
    $imageName=$publication->id.'.'.$request['img']->extension();
    $request['img']->move(public_path('images/Publications/'), $imageName);
    $publication->img =$imageName;
    $publication->save();




    return redirect()->route('publication-show');
  }


}
