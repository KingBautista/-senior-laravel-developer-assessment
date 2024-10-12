<?php

namespace App\Services;

use App\Models\User;

interface UserServiceInterface
{
    /**
     * Generate random hash key.
     *
     * @param  string $key
     * @return string
     */
    public function hash(string $key);
}