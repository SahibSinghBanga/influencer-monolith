<?php 

namespace App\Services;

class UserService extends ApiService
{
    public function __construct()
    {
        $this->endpoint = env('USERS_MS') . '/api';
    }
}