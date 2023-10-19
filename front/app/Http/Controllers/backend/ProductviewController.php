<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductviewController extends Controller
{
    public function index()
    {
        if (Session::has('token')) {
            $client = new Client();
            $token  = Session::get('token');
            $url    = 'http://127.0.0.1:8000/api/product';

            $request = $client->get($url, [
                'headers' => ['Authorization' => 'Bearer ' . $token],
            ]);

            $reponse = $request->getBody();
            $info    = json_decode($reponse, true);

            if (isset($info['success']) == true) {

                $collections = collect($info['data']);
                $massage     = $info['massage'];

                return view('posts.index', compact('collections', 'massage'));
            }

        } else {
            return redirect(route('home'))->with('Error', 'Not Loged In!');
        }
    }

    public function show($id)
    {
        if (Session::has('token')) {
            $client = new Client();
            $token  = Session::get('token');
            $url    = 'http://127.0.0.1:8000/api/product/' . $id;

            $request = $client->get($url, [
                'headers' => ['Authorization' => 'Bearer ' . $token],
            ]);

            $reponse = $request->getBody();
            $info    = json_decode($reponse, true);

            if (isset($info['success']) == true) {

                $collection = $info['data'];
                return view('posts.show', compact('collection'));
            }
        } else {
            return redirect(route('home'))->with('Error', 'Not Loged In!');
        }
    }

    public function ctreate()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:15',
            'desc' => 'required|max:15',
        ]);

        if (Session::has('token')) {
            $client       = new Client();
            $token        = Session::get('token');
            $url          = 'http://127.0.0.1:8000/api/product';
            $data['name'] = $request->name;
            $data['desc'] = $request->desc;

            $request = $client->post($url, [
                'headers'     => ['Authorization' => 'Bearer ' . $token],
                'form_params' => $data,
            ]);

            $reponse = $request->getBody();
            $info    = json_decode($reponse, true);

            if (isset($info['success']) == true) {
                return redirect(route('product.index'))->with('Success', 'Post Created!');
            }
        } else {
            return redirect(route('home'))->with('Error', 'Not Loged In!');
        }
    }

    public function edit($id)
    {
        if (Session::has('token')) {

            $client = new Client();
            $token  = Session::get('token');
            $url    = 'http://127.0.0.1:8000/api/product/' . $id;

            $request = $client->get($url, [
                'headers' => ['Authorization' => 'Bearer ' . $token],
            ]);

            $reponse = $request->getBody();
            $info    = json_decode($reponse, true);

            if (isset($info['success']) == true) {
                $collection = $info['data'];
                return view('posts.edit', compact('collection'));
            }
        } else {
            return redirect(route('home'))->with('Error', 'Not Loged In!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:15',
            'desc' => 'required|max:15',
        ]);

        if (Session::has('token')) {

            $client       = new Client();
            $token        = Session::get('token');
            $url          = 'http://127.0.0.1:8000/api/product/' . $id;
            $data['name'] = $request->name;
            $data['desc'] = $request->desc;

            $request = $client->put($url, [
                'headers'     => ['Authorization' => 'Bearer ' . $token],
                'form_params' => $data,
            ]);

            $reponse = $request->getBody();
            $info    = json_decode($reponse, true);

            if (isset($info['success']) == true) {
                return redirect(route('product.index'))->with('Success', 'Post Updated!');
            }

        } else {
            return redirect(route('home'))->with('Error', 'Not Loged In!');
        }
    }

    public function delete($id)
    {
        if (Session::has('token')) {

            $client = new Client();
            $token  = Session::get('token');
            $url    = 'http://127.0.0.1:8000/api/product/' . $id;

            $request = $client->delete($url, [
                'headers' => ['Authorization' => 'Bearer ' . $token],
            ]);

            $reponse = $request->getBody();
            $info    = json_decode($reponse, true);

            if (isset($info['success']) == true) {
                return redirect(route('product.index'))->with('Success', 'Post Deleted!');
            }

        } else {
            return redirect(route('home'))->with('Error', 'Not Loged In!');
        }
    }

}
