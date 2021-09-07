<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\GenerateTokenService;

class AuthenticateService
{
    protected $generateTokenService;

    public function __construct(GenerateTokenService $generateTokenService)
    {
        $this->generateTokenService = $generateTokenService;
    }

    public function execute(Array $credentials)
    {
        $success = false;
        $token = null;

        if (Auth::attempt($credentials)) {
            $user = User::where([
                "email" => $credentials["email"]
            ])->first();

            $token = $this->generateTokenService->execute($user);
            $success = true;
        }

        return [
            "token" => $token,
            "success" => $success
        ];
    }
}
