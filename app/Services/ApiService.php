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

    public function get($path)
    {
        return Http::acceptJson()->withHeaders([
            'Authorization' => 'Bearer ' . request()->cookie('jwt')
        ])->get("{$this->endpoint}/{$path}")->json();
    }
}