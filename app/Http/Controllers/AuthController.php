<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
Use App\Http\Requests\LoginRequest;
Use App\Http\Requests\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\ApiToken;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                $tokenExpire = Carbon::now()->addMinutes(5); 
                
                $token = $user->createToken('auth_token')->plainTextToken;
                $user->tokens()->update(['expires_at' => $tokenExpire]);
                return response()->json([
                    'status' => true,
                    'message' => 'User Login Successfully.',
                    'token' => $token,
                    'expires_at' => $tokenExpire],200);
            } else {
                throw new \Exception('User is Unauthorized');
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()],401);
        }
    }

    public function logout(Request $request)
    {
        try {
            $token = $request->user()->currentAccessToken();
    
            if ($token instanceof ApiToken) {
                $token->delete();
            }
            return response()->json([  //logging out the user
                'status' => true,
                'message' => 'User logged out successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => 'Failed to logout user'], 500);
        }
    }

    public function show()
    {
        try {
            $user = auth()->user();

            return response()->json([
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status  //getting the user details
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve user.',
                'message' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateRequest $request)
    {
        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->status = $request->status;

            $user->save(); // Updating the user details

            return response()->json([
                'status' => true,
                'message' => 'User updated successfully.',
                'data' => $user],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update user.',
                'error' => $e->getMessage()], 500);
        }
    }

    public function delete()
    {
        try {
            $user = auth()->user();
            $user->delete();   // deleting the user
    
            return response()->json([
                'status' => true,
                'message'=> 'User deleted successfully.'],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to delete user.',
                'error' => $e->getMessage()], 500);
        }
    }  
}
