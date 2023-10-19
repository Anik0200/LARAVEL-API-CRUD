<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\BaseController as BaseController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    public function index()
    {
        $products = Product::all();

        if (count($products) > 0) {

            return $this->sendResponse($products->toArray(), 'Products Retrived!');
        } else {

            return $this->sendResponse([], 'No Products Available!');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'desc' => 'required|max:200',
        ]);

        if ($validator->fails()) {

            return $this->sendError('Valid Error!', $validator->errors());
        }

        $product = Product::create([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);

        return $this->sendResponse($product->toArray(), 'Product Created!');
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!is_null($product)) {

            return $this->sendResponse($product->toArray(), 'View Products!');
        } else {

            return $this->sendResponse([], 'No Products Available!');
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'desc' => 'required|max:200',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Valid Error!', $validator->errors());
        }

        if (!is_null($product)) {

            $product->update([
                'name' => $request->name,
                'desc' => $request->desc,
            ]);

            return $this->sendResponse($product->toArray(), 'Product Updated!');
        } else {

            return $this->sendResponse([], 'No Products Available!');
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if (!is_null($product)) {

            $product->delete();
            return $this->sendResponse($product->toArray(), 'Product Deleted!');
        } else {

            return $this->sendResponse([], 'No Products Available!');
        }
    }
}
