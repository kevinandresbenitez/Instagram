<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

/*Impor model Publication*/
use App\Models\Publication;


class PublicationController extends Controller{

  public function __construct(){
    $this->middleware('auth');
  }

  public function create(){
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




    return redirect()->route('profile',['id'=>Auth::user()->id]);
  }

  public function remove($id){  

  /*Get publication */
  $publication = Publication::where('id',$id)->where('user_id',Auth::user()->id)->first();
  /*Delete img and delete publicaation */
  $img =public_path('/images/Publications/'.$publication->img);

  unlink($img);
  $publication->delete();


  return response('Delete correctly',200)->header('Content-Type', 'text/plain');    
  } 
}