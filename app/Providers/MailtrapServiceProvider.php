<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Mail\MailManager;
use Mailtrap\Helper\ResponseHelper;
use Mailtrap\MailtrapClient;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mime\MessageConverter;

class MailtrapServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->afterResolving(MailManager::class, function (MailManager $manager) {
            $manager->extend('mailtrap', function ($config) {
                return new MailtrapTransport(
                    config('mail.mailers.mailtrap.token', config('services.mailtrap.token'))
                );
            });
        });
    }
}

class MailtrapTransport extends AbstractTransport
{
    protected $client;

    public function __construct(string $token)
    {
        parent::__construct();
        $this->client = MailtrapClient::initSendingEmails(
            apiKey: $token,
            isSandbox: false // Set to false for production email sending
        );
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        try {
            $response = $this->client->send($email);

            if (!ResponseHelper::isSuccessful($response)) {
                throw new \Exception('Failed to send email via Mailtrap API');
            }
        } catch (\Exception $e) {
            throw new \Exception('Mailtrap sending failed: ' . $e->getMessage());
        }
    }

    public function __toString(): string
    {
        return 'mailtrap';
    }
}
