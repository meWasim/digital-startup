<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class ChatGptController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function askChatGpt(Request $request)
    {
        dd('hii');
        $query = $request->input('query');
dd($query);
        if (!$query) {
            return response()->json(['success' => false, 'message' => 'Query is required'], 400);
        }

        $url = "https://api.openai.com/v1/chat/completions";
        $headers = [
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ];
        $body = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $query]
            ],
            'max_tokens' => 150,
        ];

        $response = $this->apiService->makeApiCall('POST', $url, $headers, $body, 'json');

        if ($response['success']) {
            return response()->json([
                'success' => true,
                'response' => $response['data']['choices'][0]['message']['content'] ?? 'No response',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $response['message'],
                'error' => $response['error'] ?? null,
            ], $response['status']);
        }
    }
}
