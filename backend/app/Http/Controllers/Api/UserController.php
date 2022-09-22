<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;

class UserController extends Controller
{
    public function view(User $user, Request $request)
    {
        return view('users.view', ['user' => $user]);
    }
}
