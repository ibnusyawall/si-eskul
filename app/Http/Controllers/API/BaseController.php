<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($error, $data = [], $message = null)
    {
        $response = [
            'success' => $error,
            'result' => $data
        ];
        $code = $error ? 200 : 401;
        if (!isset($message)) {
            return response()->json($response, $code);
        } else {
            $response['message'] = $message;
            return response()->json($response, $code);
        }
    }

    public function wasWrong() {
        return $this->sendResponse(false, [], 'something went wrong.');
    }

    public function isEmpty()
    {
        return response()->json([
            'status' => false,
            'data' => []
        ]);
    }
}
