<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{

    public function home(){
        return view('welcome');
    }
    //
    public function login(){
        return view('login');
    }

    public function doSignOn(Request $request){

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('home');
        } else {



            return redirect()->back();
//            print_r($request['email']);
//            print_r($request['password']);exit;
//            return view('login');
        }
    }

    public function register(Request $request){
        return view('register');
    }

    public function doRegister(Request $request) {

        $this->validate($request, [
            'name' => 'required|unique:users',
            'email' => 'required|email',
            'password'=> 'required'
        ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);

        if($user->save()){
            return redirect()->route('register', ['message' => '注册成功!']);
        } else {
            return redirect()->route('register', ['message' => '注册失败!']);
        }

    }

    public function logout()
    {
        $rs = Auth::logout();
        return redirect()->route('home');
    }



}
