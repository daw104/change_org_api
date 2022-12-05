<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
                'c_password' => 'required|same:password',
            ]);
            if($validator->fails()){
                return response()->json($validator->messages(), 400);
            }
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);
            return response()->json(['message'=>'User Created','data'=>$user],200);
        }

        public function show(User $user){
            return response()->json(['message'=>'User Created satisfactoriamente','data'=>$user],200);
        }

    //mostrar todos los usuarios
    public function show_all(){
        $user = User::all();
        return response()->json($user);
    }



}
