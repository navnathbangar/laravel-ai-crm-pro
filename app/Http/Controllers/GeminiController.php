<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;

class GeminiController extends Controller
{
    public function test(GeminiService $gemini)
    {
        $response = $gemini->generate(
            "Create a Laravel Product CRUD migration"
        );

        return response()->json($response);
    }
}