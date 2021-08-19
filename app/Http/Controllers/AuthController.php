<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    //會員註冊
    public function signup(CreateUser $request)
    {
        $validateData = $request->validated();
        $user = new User([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => bcrypt($validateData['password'])
        ]);
        $user->save();
        return response('會員註冊成功' , 201);
    }
    

    //會員登入
    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|'
        ]);

        if(!Auth::attempt($validateData)){
            return response('登入授權失敗' ,401);
        }

        $user = $request->user();  //撈取使用資料
        $tokenResult = $user->createToken('Token');
        $tokenResult->token->save();
        return response(['token' => $tokenResult->accessToken]);
    }


    //GET User資料
    public function user(Request $request)
    {
        return response(
            $request->user()
        );
    }


    //會員登出token失效
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response(
            ['message'=> '成功登出']
        );
    }

}
