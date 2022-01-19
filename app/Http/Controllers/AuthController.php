<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function Auth(Request $request) {
        if ($request->cookie('api_token')) {
            return redirect(route('admin'));
        }
        return view("auth");
    }

    public function CheckAuth(Request $request) {
        $validator = Validator::make($request->all(), [
            'login' => 'required|min:4|max:50',
            'password' => 'required|min:4|max:50',
        ]);
        if ($validator->fails()) {
            return redirect(route('index'))
                        ->withErrors([
                            'error' => [
                                "code" => 422,
                                "message" => "Validation error",
                                "errors" => $validator->errors(),
                            ]
                        ])
                        ->withInput();;
        }
        $admin = Admin::Where('login', $request->login)->first();  
        if (!$admin) {
            return redirect(route('index'));
        }
        if ($admin->password !== $request->password) {
            return redirect(route('index'));
        }
        $admin->api_token = Str::random(50);

        $admin->save();
        $cookie = cookie('api_token', $admin->api_token, 60);
        return redirect(route('admin'))->cookie($cookie);
    }
}
