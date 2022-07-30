<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getLogin() {
        return view('auth.login');
    }

    public function postLogin(Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required', 
        ];
        $messages =[
            'email.required' => "Vui lòng không để trống !",
            'email.email' => "Email không đúng đinh dạng !",
            'password.required' => "Vui lòng không để trống !",
        ];
        $validator = Validator::make($request->all(),$rules, $messages);
        if($validator->fails()){
            return redirect('login')->withErrors($validator);
        }else {
            $email = $request->input('email');
            $password = $request->input('password');
            if( Auth::attempt(['email' => $email, 'password' => $password]) ){
                Session::flash('success', 'Đăng nhập thành công');
                return redirect('admin/product');
            }else{
                Session::flash('error', 'Email hoặc mật khẩu không đúng');
                return redirect('login');
            }
        }

    }

    public function getLogout(){
        Auth::logout();
        return redirect('login');
    }
}
