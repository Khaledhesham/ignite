<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\AuthenticateService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    protected $authenticateService;

    public function __construct(AuthenticateService $authenticateService)
    {
        $this->authenticateService = $authenticateService;
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
            $result["body"] = $result;
            $result["message"] = "User Logged In Successfully";
            return response()->json($result, 200);
        }

        return response()->json([
            "message" => "Unauthorized"
        ], 401);
    }
}
