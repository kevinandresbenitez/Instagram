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


  public function addComment($publication_id,$description){
 
      /*create comment  */
    $comment = new Comment();
    $comment->user_id = Auth::user()->id;
    $comment->publication_id=$publication_id;
    $comment->description =$description;
    $comment->save();

    /*Return the comment and the user what send comment */
    $comment->user= Auth::user();
    return json_encode($comment);
  }

  public function removeComment($id){

      /*Delete comment  */
    $comment =Comment::all()->where('user_id',Auth::user()->id)->where('id',$id);
    $comment->each->delete();
    return redirect()->route('home');
  }

}
