<?php

namespace App\Mail\Transport;

use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;
use Brevo\Client\Configuration;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Model\SendSmtpEmail;
use Brevo\Client\Model\SendSmtpEmailSender;
use Brevo\Client\Model\SendSmtpEmailTo;
use GuzzleHttp\Client;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

class BrevoApiTransport extends AbstractTransport
{
    protected $apiKey;
    protected $apiInstance;
    protected $logger;

    public function __construct(string $apiKey, $dispatcher = null, $logger = null)
    {
        parent::__construct();

        $this->apiKey = $apiKey;
        $this->logger = $logger;

        // Configure API key authorization
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);

        // Create API instance
        $this->apiInstance = new TransactionalEmailsApi(
            new Client(),
            $config
        );
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        // Create Brevo email object
        $sendSmtpEmail = new SendSmtpEmail();

        // Set sender
        $sender = new SendSmtpEmailSender();
        $fromAddresses = $email->getFrom();
        if (!empty($fromAddresses)) {
            $fromAddress = reset($fromAddresses);
            $sender->setEmail($fromAddress->getAddress());
            $sender->setName($fromAddress->getName() ?: 'Gereja Toraja Eben-Haezer Selili');
        }
        $sendSmtpEmail->setSender($sender);

        // Set recipients
        $recipients = [];
        foreach ($email->getTo() as $address) {
            $recipient = new SendSmtpEmailTo();
            $recipient->setEmail($address->getAddress());
            $recipient->setName($address->getName() ?: 'Penerima Email');
            $recipients[] = $recipient;
        }
        $sendSmtpEmail->setTo($recipients);

        // Set subject
        $sendSmtpEmail->setSubject($email->getSubject());

        // Set content
        $htmlBody = $email->getHtmlBody();
        $textBody = $email->getTextBody();

        if ($htmlBody) {
            $sendSmtpEmail->setHtmlContent($htmlBody);
        }

        if ($textBody) {
            $sendSmtpEmail->setTextContent($textBody);
        }

        // Send email via Brevo API
        try {
            $result = $this->apiInstance->sendTransacEmail($sendSmtpEmail);

            // Log success
            if ($this->logger) {
                $this->logger->info('Email sent successfully via Brevo API', [
                    'message_id' => $result->getMessageId(),
                    'to' => array_map(fn($r) => $r->getEmail(), $recipients),
                    'subject' => $email->getSubject()
                ]);
            }

        } catch (\Exception $e) {
            // Log error
            if ($this->logger) {
                $this->logger->error('Failed to send email via Brevo API', [
                    'error' => $e->getMessage(),
                    'to' => array_map(fn($r) => $r->getEmail(), $recipients),
                    'subject' => $email->getSubject()
                ]);
            }

            throw $e;
        }
    }

    public function __toString(): string
    {
        return 'brevo+api://default';
    }
}
