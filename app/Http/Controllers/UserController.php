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
    $this->middleware('auth',['except'=>'getAvatarDefault']);
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
      if(\Storage::disk('avatars')->exists($img)){
          \Storage::delete('/storage/app/avatars'.$img);
      }
      /*Insert and move new image*/
      $imageName=$user->id.'.'.$request['img']->extension();            
      $path =\Storage::putFileAs(
        'avatars', $request->file('img'),$imageName
      );


    }    

    /*Update user*/
    $user->name =$name;
    $user->img =$imageName;
    $user->email =$email;
    $user->password =Hash::make($password);
    $user->save();

    return redirect()->route('config')->with(['message'=>'Cambios Realizados Correctamente']);
  }

  public function profile($id){
    $user = User::all()->where('id',$id)->first();
    return view('user.profile',['user'=>$user]);
  }

  public function getAvatar($img){

    $path = storage_path('app/avatars/' . $img);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = \Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;

  }

  public function getAvatarDefault(){    
    $path = storage_path('app/avatar-default/UserDefault.png');

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
