<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller{

  public function __construct(){
    $this->middleware('auth');
  }


  public function config(Request $request){
    return view('user.config');
  }


  public function update(Request $request){
    $user = Auth::user();
    $id = $user->id;
    $name = $request->name;
    $email = $request->email;
    $password = $request->password;

    $validation = $this->validate($request ,[
        'name' => ['required', 'string', 'max:255', 'unique:users,name,'.$id],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        'password' => ['required', 'string', 'min:8'],
    ]);

    $user->name =$name;
    $user->email =$email;
    $user->password =Hash::make($password);
    $user->save();

    return redirect()->route('config')->with(['message'=>'Cambios Realizados Correctamente']);


  }


}
