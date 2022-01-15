<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/*Import comment model*/
use App\Models\Comment;

class CommentController extends Controller{

  public function __construct(){
    $this->middleware('auth');
  }


  public function addComment(Request $request){

    $comment = new Comment();
    $comment->user_id = Auth::user()->id;
    $comment->publication_id=$request->publication;
    $comment->description = isset($request->description) ? $request->description:'Comentario Normal' ;
    $comment->save();

    return redirect()->route('home');
  }

}
