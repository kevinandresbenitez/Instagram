<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/*Import class static file to delete img hold*/
use Illuminate\Support\Facades\File;
/*Impor model user*/
use App\Models\User;

class UserController extends Controller{

  public function __construct(){
    $this->middleware('auth');
  }


  public function config(Request $request){
    return view('user.config');
  }


  public function update(Request $request){

    /*Get user for update*/
    $user = Auth::user();
    $id = $user->id;
    $img=$user->img;
    $name = $request->name;
    $email = $request->email;
    $password = $request->password;

    /*Validating request*/
     $this->validate($request ,[
        'name' => ['required', 'string', 'max:255', 'unique:users,name,'.$id],
        'img' =>['image','mimes:png,jpge,jpg,gif','max:1000'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        'password' => ['required', 'string', 'min:8'],
    ]);

    /*If user upload image , update user and save image*/
    if(!empty($request['img'])){
      /*Delete image hold*/
      if(File::exists('images/UserImgProfile/'.$img) ){
              File::delete('images/UserImgProfile/'.$img);
      }
      /*Insert and move new image*/
      $imageName=$user->id.'.'.$request['img']->extension();
      $request['img']->move(public_path('images/UserImgProfile/'), $imageName);
      $user->img =$imageName;
    }

    /*Update user*/
    $user->name =$name;
    $user->email =$email;
    $user->password =Hash::make($password);
    $user->save();

    return redirect()->route('config')->with(['message'=>'Cambios Realizados Correctamente']);
  }


}
