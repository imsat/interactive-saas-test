<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->response(false, 'Invalid data!', null, $validator->errors(), 400);
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        try {
            $user = $this->userService->createOrUpdate($data);
            if($user){
                $response['user'] = $user;
                $response['token'] = $user->createToken('Authorization Token')->plainTextToken;
                return $this->response(true, 'Successfully register!', $response);
            }
        } catch (\Exception $e) {
            return $this->response(false, 'Something went wrong!', null, $e->getTrace(), 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->response(false, 'Please provide the valide data', null, $validator->errors(), 422);
        }

        $email = $request->get('email');
        $password = $request->get('password');
        $user = User::where('email', $email)->first();

        if (blank($user)) {
            return $this->response(false, 'Invalid credential!', null, [], 404);
        }

        if (!Hash::check($password, $user->password)) {
            return $this->response(false, 'Invalid credential!', null, ['password' => ['Password does not match!']], 400);
        }

        $data['user'] = $user;
        $data['token'] = $user->createToken('Authorization Token')->plainTextToken;
        return $this->response(true, 'Successfully logged in!', $data);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request.
        $request->user()->currentAccessToken()->delete();
        return $this->response(true, 'Successfully logout!.');
    }
}
