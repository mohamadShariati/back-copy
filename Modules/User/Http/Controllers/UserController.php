<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',
            'password' => ['required', 'unique:users', Password::min(5)->letters()->numbers()],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'mobile' => ['required', 'digits:11', 'unique:users'],
            'first_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
            'last_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Zء-ي ]+$/u',
            'status' => 'required|numeric|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->messages()]);
        }

        User::create([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'mobile' => $request->mobile,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'status' => $request->status,
        ]);
        return response()->json(['message' => 'user create succesfully']);
    }


    public function login()
    {
        $credential = request(['user_name', 'password']);
        if (!Auth::attempt($credential)) {
            return response()->json(['message' => 'unAutorized'], 401);
        }

        $user = request()->user();
        $token = $user->createToken('myToken')->plainTextToken;

        return response()->json(
            [
                'user' => $user,
                'token' => $token
            ]
        );
    }

    public function all()
    {
        return User::all();
    }

    public function test()
    {
        // $user = User::find(1);
        // dd($user->roles);
        $roles = User::find(1)->roles()->orderBy('name')->get();
        foreach ($roles as $role) {
            echo $role->name . "<br>";
        }
    }
}
