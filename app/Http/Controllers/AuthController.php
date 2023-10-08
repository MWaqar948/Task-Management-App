<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository = null) {
        $this->userRepository = $userRepository;
    }
    
    /**
     * Registers a new user
     */
    public function register(UserStoreRequest $request){
        $validatedData =  $request->validated();
        $user = $this->userRepository->save($validatedData);
        $token = $user->createToken('Todo-app')->plainTextToken;

        return response()->success(['user' => $user, 'token' => $token]);
    }

    /**
     * Login an existing user
     */
    public function login(Request $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (!auth()->attempt($data)) {
            return response()->unauthorized();
        }

        $token = auth()->user()->createToken('Todo-app')->plainTextToken;

        return response()->success(['user' => auth()->user(), 'token' => $token]);
    }

    /**
     * Logout a user
     */
    public function logout(Request $request){
       
        auth()->user()->tokens()->delete();
        return response()->logout();
    }
}
