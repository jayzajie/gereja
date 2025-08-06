<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\EmailVerificationCode;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Mail;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email verification functionality';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $this->info("Testing email verification for: {$email}");

        try {
            // Generate verification code
            $verification = EmailVerificationCode::generateCode($email, 'baptism');

            $this->info("Generated verification code: {$verification->code}");

            // Send email
            Mail::to($email)->send(new VerificationCodeMail($verification->code, 'baptism'));

            $this->info("✅ Email sent successfully!");
            $this->info("Check your Mailtrap inbox for the verification email.");

        } catch (\Exception $e) {
            $this->error("❌ Failed to send email: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
