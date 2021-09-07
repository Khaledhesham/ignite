<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterService
{
    /**
     * Creates user from input data
     *
     * @param Array $userData
     * @return User
     */
    public function execute(Array $userData)
    {
        $hashedPassword = Hash::make($userData["password"]);

        $storedImage = Storage::putFile('users', $userData['image']);

        $user = User::create([
            "email" => $userData["email"],
            "password" => $hashedPassword,
            "name" => $userData["name"],
            "image" => $storedImage
        ]);

        return $user;
    }
}
