<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\DomCrawler\Crawler;

class ApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Make an API call using Guzzle and handle JSON/HTML responses.
     *
     * @param string $method - HTTP method (GET, POST, etc.)
     * @param string $url - API endpoint URL
     * @param array $headers - Request headers
     * @param array $body - Request body (if any)
     * @param string $responseType - Expected response type: 'json' or 'html'
     * @return array - Processed response
     */
    public function makeApiCall($method, $url, $headers = [], $body = [], $responseType = 'json')
    {
        try {
            $options = [];

            if (!empty($headers)) {
                $options['headers'] = $headers;
            }

            if (!empty($body)) {
                $options['json'] = $body;
            }

            $response = $this->client->request($method, $url, $options);

            $content = $response->getBody()->getContents();

            if ($responseType === 'json') {
                return [
                    'success' => true,
                    'status' => $response->getStatusCode(),
                    'data' => json_decode($content, true), // Parse JSON response
                ];
            } elseif ($responseType === 'html') {
                return [
                    'success' => true,
                    'status' => $response->getStatusCode(),
                    'html' => $content, // Return raw HTML for further processing
                ];
            } else {
                return [
                    'success' => false,
                    'status' => $response->getStatusCode(),
                    'message' => 'Unsupported response type',
                ];
            }
        } catch (RequestException $e) {
            return [
                'success' => false,
                'status' => $e->getCode(),
                'message' => $e->getMessage(),
                'error' => $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null,
            ];
        }
    }

    /**
     * Parse HTML response to extract domain data.
     *
     * @param string $html - Raw HTML content
     * @return array - Extracted domain data
     */
    public function parseHtmlResponse($html)
{
    $crawler = new Crawler($html);

    $domainData = $crawler->filter('table tr')->each(function (Crawler $node) {
        $columns = $node->filter('td')->each(function (Crawler $column) {
            return $column->text();
        });

        return count($columns) === 2 ? [
            'name' => $columns[0],
            'status' => $columns[1],
        ] : null;
    });

    return array_filter($domainData);
}

}
