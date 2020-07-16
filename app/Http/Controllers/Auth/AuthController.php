<?php

namespace App\Http\Controllers\Auth;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\ResponseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;

class AuthController extends ResponseController
{
    //create user
    public function signup(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|',
            'email' => 'required|string|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        if ($user) {
            $success['token'] =  $user->createToken('token')->accessToken;
            $success['message'] = "Registration has been successfull.";

            return $this->sendResponse($success, Response::HTTP_CREATED);
        } else {
            return $this->sendError("Sorry! Registration is not successfull.", Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //login
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return $this->sendError("Unauthorized", Response::HTTP_UNAUTHORIZED);
        }

        $user = $request->user();
        $success['token'] =  $user->createToken('token')->accessToken;

        return $this->sendResponse($success);
    }

    //logout
    public function logout(Request $request): JsonResponse
    {

        $isUser = $request->user()->token()->revoke();

        if ($isUser) {
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        } else {
            $error = "Something went wrong.";
            return $this->sendResponse($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //getuser
    public function getUserInfo(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user) {
            return $this->sendResponse($user);
        } else {
            return $this->sendResponse("Not found User", Response::HTTP_NOT_FOUND);
        }
    }
}
