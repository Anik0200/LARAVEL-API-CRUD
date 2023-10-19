<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function sendResponse($result, $massage)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'massage' => $massage,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMassage = [])
    {
        $response = [
            'success' => false,
            'massage' => $error,
        ];

        if (!empty($errorMassage)) {
            $response['data'] = $errorMassage;
        }

        return response()->json($response);

    }

}
