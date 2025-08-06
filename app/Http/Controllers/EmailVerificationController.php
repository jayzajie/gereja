<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailVerificationCode;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailVerificationController extends Controller
{
    /**
     * Send verification code to email
     */
    public function sendCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'type' => 'required|in:baptism,marriage'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate verification code
            $verification = EmailVerificationCode::generateCode(
                $request->email,
                $request->type
            );

            // Send email
            Mail::to($request->email)->send(
                new VerificationCodeMail($verification->code, $request->type)
            );

            return response()->json([
                'success' => true,
                'message' => 'Kode verifikasi telah dikirim ke email Anda. Silakan cek inbox atau folder spam.',
                'expires_in' => 10 // minutes
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim email. Silakan coba lagi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Verify the code
     */
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'code' => 'required|string|size:6',
            'type' => 'required|in:baptism,marriage'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        $isValid = EmailVerificationCode::verifyCode(
            $request->email,
            $request->code,
            $request->type
        );

        if ($isValid) {
            return response()->json([
                'success' => true,
                'message' => 'Email berhasil diverifikasi! Anda dapat melanjutkan pendaftaran.',
                'verified' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kode verifikasi tidak valid atau sudah kedaluwarsa. Silakan minta kode baru.',
                'verified' => false
            ], 400);
        }
    }

    /**
     * Check if email is already verified
     */
    public function checkVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'type' => 'required|in:baptism,marriage'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        $isVerified = EmailVerificationCode::isEmailVerified(
            $request->email,
            $request->type
        );

        return response()->json([
            'success' => true,
            'verified' => $isVerified,
            'message' => $isVerified ? 'Email sudah terverifikasi' : 'Email belum terverifikasi'
        ]);
    }
}
