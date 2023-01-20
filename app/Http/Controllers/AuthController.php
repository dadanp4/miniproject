<?php

namespace App\Http\Controllers;

use App\tb_m_client;
use App\tb_m_project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request){
        $validator = FacadesValidator::make(request()->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());            # code...
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return response()->json(['message' => 'Berhasil Register']);
        }else{
            return response()->json(['message' => 'Gagal Register']);
        }
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Email atau password tidak sesuai'], 401);
        }else{
            // return $this->respondWithToken($token);
            session(['token' => $token]);
            return redirect('api/auth/index');
        }
    }

    public function me()
    {
        // return response()->json(auth()->user());
        return User::all();
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
