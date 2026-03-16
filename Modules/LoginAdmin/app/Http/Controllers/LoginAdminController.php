<?php

namespace Modules\LoginAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('loginadmin::index');
    }

    public function login(Request $request){
        $validated =  $request->validate([
              'username' => 'required',
              'password' => 'required'
          ]);
          if(Auth::attempt($validated)){
              $request->session()->regenerate();
              return redirect()->intended('/dashboard');
          }
          return back()->with('loginFailed', 'Password atau Username Salah!');
      }
      
      public function logout(Request $request){
          Auth::logout();
      
          $request->session()->invalidate();
      
          $request->session()->regenerateToken();
      
          return redirect('/login-admin');
      }
}