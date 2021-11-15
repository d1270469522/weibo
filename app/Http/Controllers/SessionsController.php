<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email'    => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials, $request->has('remeber'))) {

            session()->flash('success', '欢迎回来～！');
            $fallback = route('users.show', [Auth::user()]);
            return redirect()->intended($fallback);
        } else {

            session()->flash('danger', '抱歉，账号或密码错误～！');
            return redirect()->back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '退出成功～！');
        return redirect()->route('login');
    }
}
