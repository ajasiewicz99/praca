<?php

namespace App\Module\User\Infrastructure\Messenger;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler]
class SendEmailMessageHandler
{
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(SendEmailMessage $message): void
    {
        $email = (new Email())
            ->from('noreply@dietixSmartCode.com')
            ->to($message->getRecipient())
            ->subject($message->getSubject())
            ->html($message->getContent());

        $this->mailer->send($email);
    }
}
