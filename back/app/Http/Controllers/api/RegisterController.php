<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class RegisterController extends BaseController
{
    public function register(Request $request)
    {
        $validator = FacadesValidator::make($request->all(),
            [
                'name'             => 'required|max:20',
                'email'            => 'required|max:100',
                'password'         => 'required|min:2',
                'confirm_password' => 'required|same:password',
            ]);

        if ($validator->fails()) {

            return $this->sendError('validation error!', $validator->errors());
        } elseif (User::where('email', '=', $request->email)->count() > 0) {

            return $this->sendError('User Already Exist!', []);
        } else {

            $password = bcrypt($request->password);

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $password,
            ]);

            $success['token'] = $user->createToken('Api')->plainTextToken;
            $success['name']  = $user->name;

            return $this->sendResponse($success, 'User Registered!');
        }
    }

    public function login(Request $request)
    {
        $validator = FacadesValidator::make($request->all(),
            [
                'email'    => 'required|max:100',
                'password' => 'required|min:2',
            ]);

        if ($validator->fails()) {

            return $this->sendError('validation error!', $validator->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user             = Auth::user();
            $success['token'] = $user->createToken('Api')->plainTextToken;
            $success['name']  = $user->name;
            return $this->sendResponse($success, 'Loged In!');

        } else {

            return $this->sendError('UnAuthoRized!', ['error' => 'UnAuthoRized!']);
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return $this->sendResponse([], 'Loged Out!');
    }

}
