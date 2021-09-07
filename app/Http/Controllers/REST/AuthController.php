<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthenticateService;
use App\Http\Services\GenerateResponseService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    protected $authenticateService;
    protected $generateResponseService;

    public function __construct(
        AuthenticateService $authenticateService,
        GenerateResponseService $generateResponseService
    ) {
        $this->authenticateService = $authenticateService;
        $this->generateResponseService = $generateResponseService;
    }
    /**
     * Login User via email and password
     *
     * @param LoginRequest $request
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        $result = $this->authenticateService->execute($request->validated());

        if ($result["success"]) {
            return $this->generateResponseService->execute(
                "User Logged In Successfully",
                200,
                $result
            );
        }

        return $this->generateResponseService->execute(
            "Unauthorized",
            401,
            []
        );
    }
}
