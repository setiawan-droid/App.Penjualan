<?php

namespace App\Helpers;

class ResponseFormatter
{
    public static function view($view, $data = [])
    {
        return view($view, $data);
    }

    public static function successRedirect($route, $message)
    {
        return redirect()->route($route)->with('success', $message);
    }

    public static function errorRedirect($route, $message)
    {
        return redirect()->route($route)->with('error', $message);
    }

    public static function jsonSuccess($message, $data = [], $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public static function jsonError($message, $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $status);
    }
}
