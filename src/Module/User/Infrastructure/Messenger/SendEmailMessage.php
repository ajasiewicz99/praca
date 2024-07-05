<?php

namespace App\Module\User\Infrastructure\Messenger;

class SendEmailMessage
{
    private string $recipient;
    private string $subject;
    private string $content;

    public function __construct(string $recipient, string $subject, string $content)
    {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}
