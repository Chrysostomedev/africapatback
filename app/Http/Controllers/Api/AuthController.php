<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Connect or Register via Wallet Address
     */
    public function connectWallet(Request $request)
    {
        $request->validate([
            'wallet_address' => 'required|string|size:42', // Format Ethereum/Polygon
            // 'signature' => 'required|string', // Pour une auth plus robuste plus tard
        ]);

        $wallet = strtolower($request->wallet_address);

        $user = User::firstOrCreate(
            ['wallet_address' => $wallet],
            [
                'id' => (string) Str::uuid(),
                'pseudo' => 'Player_' . substr($wallet, -4),
            ]
        );

        // Créer le profil Player si inexistant
        if (!$user->player) {
            Player::create([
                'id' => (string) Str::uuid(),
                'user_id' => $user->id,
            ]);
        }

        $user->update(['last_login_at' => now()]);

        $token = $user->createToken('akwaba_auth')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'user' => $user->load('player'),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
}
