<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserManagement extends Controller
{
    public function updateUserProfile(Request $request): JsonResponse
    {
        $request->validate([
            'account_number' => 'required|unique:customers,email',
        ]);
        
    }
}
