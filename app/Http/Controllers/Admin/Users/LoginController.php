<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
  public function index(){
      return view('admin.users.login', [
          'title' => 'Đăng Nhập Hệ Thống'
      ]);
  }


    public function store(Request $request)
  {
      if (Auth::attempt(['email'=>$request->email,'password'=>$request->password, ])){
          return redirect()->route('admin');
      }
      Session::flash('error', 'Email hoặc Password không đúng');
      return back();
  }

}
