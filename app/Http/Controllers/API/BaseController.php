<?php


namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller as Controller;


class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */


    public function applyAcosDistance($query, $lat, $lng, $radius, $latColumn = 'lat', $lngColumn = 'long')
    {
        $latRange = $radius / 111;
        $lngRange = $radius / (111 * cos(deg2rad($lat)));

        $distanceSql = "
        (
            6371 * ACOS(
                COS(RADIANS(?))
                * COS(RADIANS($latColumn))
                * COS(RADIANS(`$lngColumn`) - RADIANS(?))
                + SIN(RADIANS(?))
                * SIN(RADIANS($latColumn))
            )
        )
    ";

        $bindings = [$lat, $lng, $lat];

        $query->selectRaw("$distanceSql AS distance", $bindings)
            ->whereBetween($latColumn, [$lat - $latRange, $lat + $latRange])
            ->whereBetween($lngColumn, [$lng - $lngRange, $lng + $lngRange])
            ->whereRaw("$distanceSql <= ?", array_merge($bindings, [$radius]));
    }


    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendCustomError($result, $message)
    {
        $response = [
            'success' => false,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 404);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
    public function sendErrorMethodNotFound($error, $errorMessages = [], $code = 405)
    {
        $response = [
            'success' => false,
            'message' => 'Method Not Supported',
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendErrorActive($error, $errorMessages = [], $code = 403)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendErrorPayment($error, $errorMessages = [], $code = 402)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendInsufficient($error, $errorMessages = [], $code = 507)
    {
        $response = [
            'success' => true,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    public function noContent($error, $errorMessages = [], $code = 204)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function sendErrorAuth($error, $errorMessages = [], $code = 401)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
