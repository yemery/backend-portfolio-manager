<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email:rfc,dns', 'unique:users'],
            'password' => ['required'],
        ], [
            'required' => 'The :attribute field is required.',
            'email:rfc,dns' => 'The :attribute must be a valid email address.',
            'unique' => 'The :attribute must be unique.'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken("API Token " . $user['email'])->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
            'Type' => 'Bearer',

        ]);
    }
   
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email:rfc,dns', ],
            'password' => ['required'],
        ], [
            'required' => 'The :attribute field is required.',
            'email:rfc,dns' => 'The :attribute must be a valid email address.',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user=User::where('email',$request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password) ) {
            return response()->json([
                'message'=>'No such scredentials retry',
            ]);
        }
        $token = $user->createToken("API Token " . $user['email'])->plainTextToken;
        return response()->json([
            'user' => $user,
            'token' => $token,
            'Type' => 'Bearer',

        ]);

    }
    public function logout()
    {
       auth()->user()->tokens()->delete();
        // $tokensCheck=auth()->user()->tokens;
        return response()->json([
           'message'=>'logout secc',
        //    'tokens'=>$tokensCheck
        ]);

        
    }
}
