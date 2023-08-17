<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
   public function index(){
    return "Hello from UserController";
   }

   //LOGIN
   public function login(){
      if(View::exists('user.login')){
         return view('user.login');
      }else{
         // return response()->view('errors.404');
         return abort(404);
      }
   }

   //LOGIN-PROCESS
   public function process(Request $request){
      $validated = $request->validate([   
         "email" => ['required', 'email'],
         'password' => 'required'
      ]);

      if(auth()->attempt($validated)){
         $request->session()->regenerate();

         return redirect('/')->with('message', 'Welcome Back!');
      }

      //para sa login.blade.php error 
      return back()->withErrors(['email' => 'Login Failed!'])->onlyInput('email');

   }

   //REGISTER
   public function register(){
      return view('user.register');
   }

   //store for register form - register.blade.php
   public function store(Request $request){
      // dd($request);
      $validated = $request->validate([   
         "name" => ['required', 'min:4'],
         "email" => ['required', 'email', Rule::unique('users', 'email')],
         'password' => 'required|confirmed|min:6'
      ]);

      //hash password
      // $validated['password'] = Hash::make($validated['password']);
      // OR kahit ano sa dalawa
      $validated['password'] = bcrypt($validated['password']);

      $user = User::create($validated);

      //authentication direct login after register
      auth()->login($user);
     
   }

   //LOGOUT
   public function logout(Request $request){
      auth()->logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect('/login')->with('message', 'Logout successful');
   }


   public function show($id){   
    $data = ["data" => "data from database"];
    return view('user')
        ->with('data' , $data)
        ->with('name' , 'Kim Martel Olives')
        ->with('age' , 22)
        ->with('email' , 'kimmartel.olives@gmail.com')
        ->with('id' , $id);
   }
}
