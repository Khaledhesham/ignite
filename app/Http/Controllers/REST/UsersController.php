<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\GenerateResponseService;
use App\Http\Services\GenerateTokenService;
use App\Http\Services\RegisterService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $generateTokenService;
    protected $generateResponseService;
    protected $registerService;

    public function __construct(
        GenerateTokenService $generateTokenService,
        GenerateResponseService $generateResponseService,
        RegisterService $registerService
    ) {
        $this->generateTokenService = $generateTokenService;
        $this->generateResponseService = $generateResponseService;
        $this->registerService = $registerService;
    }

    public function create(RegisterRequest $request)
    {
        $validatedData = $request->validated();

        $user = $this->registerService->execute($validatedData);

        $token = $this->generateTokenService->execute($user);

        return $this->generateResponseService->execute(
            "User Registered Successfully",
            201,
            [
                "user" => $user->toArray(),
                "token" => $token
            ]
        );
    }

    public function currentUser(Request $request)
    {
        $user = $request->user();

        return $this->generateResponseService->execute(
            "User Retrieved Successfully",
            200,
            [
                "user" => $user->toArray()
            ]
        );
    }
}
