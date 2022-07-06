<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function login(Request $request){
        if ($request->input('username')=="taavi" && $request->input('password')=='hansing')
        {
            return ['status'=>'success', 'msg'=>"login succsessful"];
        }
        else{
            return ['status'=>'failed', 'msg'=>"login FAILED"];

        }
    }

}
