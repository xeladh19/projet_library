<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    /**
     * Register new user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {

        if (User::where('email', $request->email)->first()) {
            $response = [
                'success' => false,
                'message' => "L'utilisateur existe déjà dans la base de données."
            ];
        } else {
            try {
                request()->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'email', 'max:255'],
                    'password' => ['required', 'string', 'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', 'confirmed']
                ]);

                User::create([
                    'name' => $request->name,
                    'pseudo' => $request->pseudo,
                    'avatar' => $request->avatar,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
                Auth::attempt($request->only('email', 'password'));
                Session::regenerate();
                $response = [
                    'success' => true,
                    'token' => Auth::user()->createToken('together_token')->plainTextToken,
                    'user_tokens' => Auth::user()->tokens
                ];
            } catch (\Illuminate\Database\QueryException $ex) {
                $response = [
                    'success' => false,
                    'message' => $ex->getMessage()
                ];
            }
        }

        return response()->json($response);
    }


    /**
     * Login user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {

        if (Auth::attempt($request->only('email', 'password'))) {
            Session::regenerate();
            $response = [
                'success' => true,
                'token' => Auth::user()->createToken('together_token')->plainTextToken,
                'user_tokens' => Auth::user()->tokens
            ];
        } else if (!User::where('email', $request->email)->first()) {
            $response = [
                'success' => false,
                'message' => "L'adresse email n'existe pas dans la base de données."
            ];
        } else {
            $response = [
                'success' => false,
                'message' => "Les données sont incorrectes."
            ];
        }

        return response()->json($response);
    }


    /**
     * Logout user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::user()->tokens->each->delete();

        Session::flush();

        return response()->json([
            'success' => true,
            'message' => "Vous êtes déconnecté."
        ]);
    }
}
