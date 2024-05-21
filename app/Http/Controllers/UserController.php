<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Carbon;


class UserController extends Controller
{

    public function register(CreateRequest $request)
    {
       try {
        $user = new User();  
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        $user->save();    // creating the new user
        
        Mail::to($user->email)->send(new WelcomeMail($user));
        
        return response()->json([
                'status' => true,
                'message' => 'Registration successfully.',
                'data' => $user],201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => 'Registration failed.'],422);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $tokenExpire = Carbon::now()->addMinutes(5); // Set the expiration time to 2 hours

                $token = Auth::guard('api')->attempt($credentials);
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

    public function logout()
    {
        try {
             Auth::guard('api')->logout();

            return response()->json([  //logging out the user
                'status' => true,
                'message' => 'User logged out successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => 'Failed to logout user'], 500);
        }
    }

    public function index()
    {
        try {
            $users = User::all(); // Getting the list of users

            return response()->json([
                'status' => true,
                'message' => 'Users list.',
                'data' => $users],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to retrieve users list.',
                'error' => $e->getMessage()],500);
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
