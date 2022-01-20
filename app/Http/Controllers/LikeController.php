<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*Import models  */
use App\Models\Like;

class LikeController extends Controller{

  public function __construct(){
    $this->middleware('auth') ;
  }

  public function giveLike($publication){
    /*If like exist redirect to delete*/
    $like = Like::all()->where('publication_id',$publication)->where('user_id',Auth::user()->id);
    if($like->count()){
        return redirect()->route('like-remove',['publication'=>$publication]);
    }


    /*create like*/
    $like =new Like();
    $like->publication_id = $publication;
    $like->user_id =Auth::user()->id;
    $like->save();

    return redirect()->route('home');

  }


  public function removeLike($publication){
    $like = Like::where('publication_id',$publication)->where('user_id',Auth::user()->id)->delete();
    return redirect()->route('home');
  }

  /*Get liked publications by the user */
  public function getLikedPublications(){
    $likes= Like::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(5);
    return view('user.liked-publications',['likes'=>$likes]);
    }

}
