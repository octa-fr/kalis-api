<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)  
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'user'    
            ]);

            return response()->json([
                'message' => 'Register success',
                'user'    => $user
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Periksa Email/Password',
                'errors'  => $e->errors(),
            ], 422);
        }
    }


    function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'user'    => $user,
            'token'   => $token,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout success'
        ]);
    }   

    public function index()
    {
        $users = User::where('role', 'user')->get();

        return response()->json($users);
    }
    
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        // kalau tidak ingin admin bisa dihapus, tambahkan check
        if ($user->role === 'admin') {
            return response()->json(['message' => 'Admin tidak boleh dihapus'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }

}
