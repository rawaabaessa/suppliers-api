<?php

namespace App\Http\Controllers;

use App\Models\BankInfo;
use App\Models\Farmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 1,
        ]);

        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);
        $user = User::with(['role', 'farmer'])
                        ->where('email', $request->email)
                        ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Logged out successfully'
    ]);
}
public function me(Request $request)
{
    return response()->json($request->user());
}

public function registerFarmer(Request $request)
{
    $validated = $request->validate([
        // farm info
        'farmName' => 'required|string',
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string',
        'password' => 'required|min:8',

        // address
        'city' => 'required|string',
        'neighborhood' => 'required|string',
        'street' => 'required|string',

        // bank
        'bankName' => 'required|string',
        'accountHolderName' => 'required|string',
        'iban' => 'required|string',
    ]);

    // 1. create user
    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'role_id' => 2,
    ]);

    // 2. create farmer profile
    $farmer = Farmer::create([
        'user_id' => $user->id,
        'farm_name' => $validated['farmName'],
        'phone' => $validated['phone'],
        'city' => $validated['city'],
        'neighborhood' => $validated['neighborhood'],
        'street' => $validated['street'],
        'status' => 'pending',
    ]);

    // 3. bank info (إذا عندك جدول منفصل)
    BankInfo::create([
        'farmer_id' => $farmer->id,
        'bank_name' => $validated['bankName'],
        'account_holder_name' => $validated['accountHolderName'],
        'iban' => $validated['iban'],
    ]);

    // 4. token
    $token = $user->createToken('auth')->plainTextToken;

    return response()->json([
        'message' => 'Farmer registered successfully',
        'user' => $user,
        'token' => $token,
    ]);
}
}
