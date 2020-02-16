<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => ['create']]);
    }

    public function create()
    {

        return view('sessions.create');

    }

    public function store(Request $request)
    {

        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        //attempt方法的使用 ：attempt(['email' => $email, 'password' => $password])
        //密码和邮箱验证
        if (Auth::attempt($credentials, $request->has('remeber'))) {

            if (Auth::user()->activated) {

                session()->flash('success', '欢迎回来');

                $fallback = route('users.show', [Auth::user()]);

                return redirect()->intended($fallback);

            } else {

                Auth::logout();
                session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }
        } else {

            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();

        }
    }

    public function destroy()
    {

        Auth::logout();

        session()->flash('success', '您已成功退出，拜拜！');

        return redirect('login');

    }

}
