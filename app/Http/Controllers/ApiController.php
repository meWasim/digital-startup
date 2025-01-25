<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function getDomainStatus(Request $request)
    {
        // dd('hii');
        // dd($request->query('domain'));

        $domainName = $request->query('domain');

        if (!$domainName) {
            return response()->json(['success' => false, 'message' => 'Domain name is required'], 400);
        }

        $url = "https://digitalstartups.in/domain-list.php?domain=".$domainName;
        $response = $this->apiService->makeApiCall('GET', $url, [], [], 'html');

        if ($response['success']) {
            // Parse HTML response
            $domains = $this->apiService->parseHtmlResponse($response['html']);

            return response()->json([
                'success' => true,
                'domains' => $domains,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $response['message'],
            ], $response['status']);
        }
    }
}
