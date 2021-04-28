<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $weatherService = app('app.weather-service');
        $name = $request->get('name', null);
        $data = $weatherService->getData($name);

        return response()->json($data);
    }
}
