<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller implements HasMiddleware
//class LoginController extends Controller
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth:api', except: ['login'])
        ];
    }

    /**
     * Login valid user and return token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(false, 'Invalid data!', null, 400, $validator->errors());
        }
        $credential = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credential)) {
                return $this->apiResponse(false, 'Wrong email or password!!', null, 403, $validator->errors());
            }

            $userData = auth()->user()->only(['id', 'name', 'email', 'email_verified_at']);

            $data = [
                'token' => $token,
                'user' => $userData,
                'message' => 'Login successfully',
            ];
            return $this->apiResponse(true, 'Login successfully.', $data);

        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 400);
        }
    }

    /**
     * Logout authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth('api')->logout();
            return $this->apiResponse(true, 'Logout successfully.');
        } catch (\Exception $e) {
            return $this->apiResponse(false, $e->getMessage() ?? 'Something went wrong!', null, 400);
        }
    }

}
