<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

abstract class ApiService
{
    protected string $endpoint;

    public function post($path, $data)
    {
        return Http::post("{$this->endpoint}/{$path}", $data)->json();
    }
}