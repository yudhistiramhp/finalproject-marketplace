<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json([
                "data" => [
                    "errors" => $validator->invalid()
                ]
                ], 422);
        }

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect!'],
            ]);
        }

        $token = $user->createToken('tokenName')->plainTextToken;

        return response()->json([
            "data" => [
                "token" => $token
            ]
            ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 8 digit!',
        ]);
        
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        return response()->json(['message' => 'Berhasil register!'], 201);
    }

    public function logout(Request $request)
    {
        if(!$request->user()){
            return response()->json(['error' => 'belum login'], 401);
        }
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Berhasil logout!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
