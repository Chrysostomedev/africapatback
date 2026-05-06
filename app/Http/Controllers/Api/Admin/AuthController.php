<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Contrôleur AuthController pour les Administrateurs
 * 
 * Gère le login classique Email/Password pour le staff AKWABA.
 */
class AuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * Connexion Administrateur
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return $this->error('Identifiants admin incorrects.', 401);
        }

        $token = $admin->createToken('admin_auth')->plainTextToken;

        return $this->success([
            'admin' => $admin,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 'Connexion administrateur réussie.');
    }
}
