<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->model = config('services.openai.model');
    }

    public function generate(string $prompt): string
    {
        $response = Http::withToken($this->apiKey)
            ->post('https://api.openai.com/v1/responses', [

                'model' => $this->model,

                'input' => $prompt,

            ]);

        if ($response->failed()) {

            throw new \Exception(
                $response->body()
            );

        }

        return $response->json('output.0.content.0.text');
    }
}