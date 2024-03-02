<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function register(Request $request): JsonResponse
    {
        $this->validate($request,[
           'email'=>'required|email|string|max:255',
           'name'=>'required|string|max:255',
           'password'=>'required|max:10'
        ]);
        $user = User::create([
           'email'=>$request->input('email'),
           'name'=>$request->input('name'),
           'password'=>$request->input('password'),
        ]);
        return $this->OkResponse($user, 'user');
    }
}
