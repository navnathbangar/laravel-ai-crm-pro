<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    private string $apiKey;
    private string $model;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->model = config('services.gemini.model');
    }

    public function generate($prompt)
    {
        $apiKey = env('GEMINI_API_KEY');
        $model = env('GEMINI_MODEL');

        $url = "https://generativelanguage.googleapis.com/v1beta/models/".$this->model.":generateContent?key=".$this->apiKey;

        for ($i = 1; $i <= 3; $i++) {

            $response = Http::timeout(60)->post($url, [
                "contents" => [
                    [
                        "parts" => [
                            [
                                "text" => $prompt
                            ]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
            }

            if ($response->status() == 503) {
                sleep(5);
                continue;
            }

            $data = $response->json();

            return $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
        }

        return [
            "error" => "Gemini server busy. Please try again."
        ];
    }

    public function generate1($prompt)
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/".$this->model.":generateContent?key=".$this->apiKey;
        
        $response = Http::post($url, [

            'contents' => [

                [

                    'parts' => [

                        [

                            'text' => $prompt

                        ]

                    ]

                ]

            ]

        ]);

        if ($response->failed()) {

            throw new \Exception($response->body());

        }
        return $response->json();

       //return $response['candidates'][0]['content']['parts'][0]['text'] ?? '';
    }
}