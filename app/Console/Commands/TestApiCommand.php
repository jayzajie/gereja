<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EmailVerificationCode;

class TestApiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test complete email verification flow';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $this->info("🧪 Testing Email Verification API Flow");
        $this->info("Email: {$email}");
        $this->line("");

        // Step 1: Generate and send code
        $this->info("📧 Step 1: Generating verification code...");
        try {
            $verification = EmailVerificationCode::generateCode($email, 'baptism');
            $this->info("✅ Code generated: {$verification->code}");
            $this->info("⏰ Expires at: {$verification->expires_at}");
        } catch (\Exception $e) {
            $this->error("❌ Failed to generate code: " . $e->getMessage());
            return 1;
        }

        // Step 2: Test verification
        $this->line("");
        $this->info("🔍 Step 2: Testing code verification...");
        try {
            $isValid = EmailVerificationCode::verifyCode($email, $verification->code, 'baptism');
            if ($isValid) {
                $this->info("✅ Code verification successful!");
            } else {
                $this->error("❌ Code verification failed!");
                return 1;
            }
        } catch (\Exception $e) {
            $this->error("❌ Verification error: " . $e->getMessage());
            return 1;
        }

        // Step 3: Test email verification status
        $this->line("");
        $this->info("📋 Step 3: Checking email verification status...");
        try {
            $isVerified = EmailVerificationCode::isEmailVerified($email, 'baptism');
            if ($isVerified) {
                $this->info("✅ Email is verified and valid for form submission!");
            } else {
                $this->error("❌ Email verification status check failed!");
                return 1;
            }
        } catch (\Exception $e) {
            $this->error("❌ Status check error: " . $e->getMessage());
            return 1;
        }

        // Summary
        $this->line("");
        $this->info("🎉 All tests passed! Email verification system is working correctly.");
        $this->line("");
        $this->comment("Next steps:");
        $this->comment("1. Test the frontend modal on: http://127.0.0.1:8001/contact/pengelolaan-baptis");
        $this->comment("2. Fill the baptism form and test email verification");
        $this->comment("3. Check email logs or Mailtrap for email delivery");

        return 0;
    }
}
