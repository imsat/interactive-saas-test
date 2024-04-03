<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->apiResponse(false, 'Please provide valid data!', null, 400, $validator->errors());
        }
        try {

            $data = $request->only(['name', 'email', 'password']);
            $user = $this->userService->save($data);

            if (!$token = JWTAuth::attempt([
                "email" => $data['email'],
                "password" => $data['password'],
            ])) {
                return $this->apiResponse(false, 'Unauthorized', null, 401, $validator->errors());
            }

            $userData = [
                'token' => $token,
                'user' => $user
            ];

            return $this->apiResponse(true, 'User created successfully.', $userData);

        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 400);
        }
    }
}
