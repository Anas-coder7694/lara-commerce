<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class ForgetPasswordController extends Controller
{
    public function sendResetLink(Request $request):JsonResponse{
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Reset link sent to email'])
            : response()->json(['message' => 'Unable to send reset link'], 500);
    }
}
