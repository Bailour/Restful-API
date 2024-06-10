<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return response()->json(['users' => $users]);
    }

    public function store(Request $request){
        $request->validate([
            'name' =>'required',
            'email' =>'required',
            'password' => 'required'
        ]);
        $user=User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User Created'], 201);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' =>'required',
            'email' =>'required',
            'password' => 'required'
        ]);
        $user = User::find($id);
        $user->update($request->all());

        return response()->json(['message' => 'User Updated'], 200);
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();

        return response()->json(['message' => 'User Deleted'], 200);
    }

    public function login(Request $request){
        $request->validate([
            'email' =>'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user ||!Hash::check($request->password, $user->password)){
            return response()->json(['error' => 'Unauthorised'], 401);
        }
        $token = $user->createToken('authToken')->plainTextToken;
        $response = [
            'AccessToken' => $token
        ];
        return response()->json($response, 200);
    }
}
