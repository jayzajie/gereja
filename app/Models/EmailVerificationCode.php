<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class EmailVerificationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code',
        'type',
        'is_verified',
        'expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_verified' => 'boolean'
    ];

    /**
     * Generate a new verification code
     */
    public static function generateCode($email, $type = 'baptism')
    {
        // Delete old codes for this email and type
        self::where('email', $email)
            ->where('type', $type)
            ->delete();

        // Generate 6-digit code
        $code = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);

        // Create new verification code
        return self::create([
            'email' => $email,
            'code' => $code,
            'type' => $type,
            'expires_at' => Carbon::now()->addMinutes(10), // Expires in 10 minutes
        ]);
    }

    /**
     * Verify a code
     */
    public static function verifyCode($email, $code, $type = 'baptism')
    {
        $verification = self::where('email', $email)
            ->where('code', $code)
            ->where('type', $type)
            ->where('is_verified', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($verification) {
            $verification->update(['is_verified' => true]);
            return true;
        }

        return false;
    }

    /**
     * Check if email is verified for a specific type
     */
    public static function isEmailVerified($email, $type = 'baptism')
    {
        return self::where('email', $email)
            ->where('type', $type)
            ->where('is_verified', true)
            ->where('expires_at', '>', Carbon::now()->subHours(1)) // Valid for 1 hour after verification
            ->exists();
    }
}
