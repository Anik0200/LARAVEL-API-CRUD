<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function login_form()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);

        $client           = new Client();
        $url              = 'http://127.0.0.1:8000/api/login';
        $data['email']    = $request->email;
        $data['password'] = $request->password;

        $request = $client->post($url, [
            'form_params' => $data,
        ]);

        $reponse = $request->getBody();
        $info    = json_decode($reponse, true);

        if (isset($info['data']['error']) == true) {

            return redirect(route('login.form'))->with('Error', $info['massage']);
        } elseif (isset($info['data']['token'])) {

            Session::put('token', $info['data']['token']);
            return redirect(route('home'))->with('Success', 'Loged In!');
        }

    }

    public function register_form()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'             => 'required|max:20',
            'email'            => 'required|max:100',
            'password'         => 'required|min:2',
            'confirm_password' => 'required|same:password',
        ]);

        $client                   = new Client();
        $url                      = 'http://127.0.0.1:8000/api/register';
        $data['name']             = $request->name;
        $data['email']            = $request->email;
        $data['password']         = $request->password;
        $data['confirm_password'] = $request->confirm_password;

        $request = $client->post($url, [
            'form_params' => $data,
        ]);

        $reponse = $request->getBody();
        $info    = json_decode($reponse, true);

        if (isset($info['data']['token'])) {

            return redirect(route('home'))->with('Success', 'Registered!');
        } elseif (isset($info['massage']) == 'User Already Exist!') {

            return redirect(route('home'))->with('Error', 'Alreay Registered!');
        } else {

            return redirect(route('home'))->with('Error', 'Please Try Again!');
        }
    }

    public function logout()
    {
        if (Session::has('token')) {
            Session::forget('token');
            return redirect(route('home'))->with('Success', 'Loged Out!');
        }
    }
}
