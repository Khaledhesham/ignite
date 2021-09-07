<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GenerateTokenService
{
    public function execute(User $user)
    {
        return $user->createToken("Auth")->plainTextToken;
    }
}
