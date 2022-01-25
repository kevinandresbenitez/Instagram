<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

/*Impor model Publication*/
use App\Models\Publication;
/*Import class static file*/
use Illuminate\Support\Facades\File;


class PublicationController extends Controller{

  public function __construct(){
    $this->middleware('auth');
  }

  public function create(){
    return view('publications.create');
  }

  public function save(Request $request){

    /*Validate Request */
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
    $imageName=$publication->id.'.'.$request->file('img')->extension();    
    $publication->img = $imageName;
    $path = Storage::putFileAs(
      'publications', $request->file('img'),$imageName
    );
    

    /*Save Publication */
    $publication->save();

    return redirect()->route('profile',['id'=>Auth::user()->id]);
  }

  public function remove($id){  

  /*Get publication */
  $publication = Publication::where('id',$id)->where('user_id',Auth::user()->id)->first();
  /*Delete img and delete publicaation */
  $img =storage_path('app/publications/' . $publication->img);
  
  File::delete($img);
  $publication->delete();


  return response('Delete correctly',200)->header('Content-Type', 'text/plain');    
  } 

  public function getImg($img){

    $path = storage_path('app/publications/'.$img);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = \Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
  }
}