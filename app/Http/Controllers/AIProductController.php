<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService;

class AIProductController extends Controller
{
    public function generateDescription(Request $request, GeminiService $gemini) 
    {

        $request->validate([
            'product_name' => 'required'
        ]);


        $prompt = "
            You are an expert eCommerce SEO copywriter.

            Product Name:
            {$request->product_name}

            Return ONLY valid JSON.

            {
            \"description\":\"2-3 lines description\",
            \"meta_title\":\"SEO title under 60 chars\",
            \"meta_description\":\"SEO description under 160 chars\",
            \"meta_keywords\":\"keyword1, keyword2, keyword3\",
            \"tags\":\"tag1, tag2, tag3\"
            }
            
            Do not return HTML.
            Do not return markdown.
            Do not return explanation.
            Return only JSON.
            ";

            


        $response = $gemini->generate($prompt);

        $data = json_decode($response, true);

        return response()->json([
            'description'      => $data['description'] ?? '',
            'meta_title'       => $data['meta_title'] ?? '',
            'meta_description' => $data['meta_description'] ?? '',
            'meta_keywords'    => $data['meta_keywords'] ?? '',
            'tags'             => $data['tags'] ?? '',
        ]);
    }
}