<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

/**
 * @property string apiKey
 */
class CatController extends Controller
{
    public function __construct()
    {
        $this->apiKey = env('CAT_API_KEY', 'DEMO-API-KEY');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function random()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.thecatapi.com/v1/images/search', [
            'x-api-key' => $this->apiKey
        ]);
        $result = json_decode($response->getBody());

        return response()
            ->json([
                'url' => $result[0]->url
            ])
            ->header('Cache-Control', 'no-cache');
    }
}
