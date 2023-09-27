<?php

namespace ReesMcIvor\Forms\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use ReesMcIvor\Forms\Models\FormEntry;
use ReesMcIvor\Forms\View\Components\Completed;

class FormCompletedNotification extends Notification
{
    private FormEntry $formEntry;

    public function __construct(FormEntry $formEntry)
    {
        $this->formEntry = $formEntry;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->view("forms::emails.completed", [
            "formEntryHtml" => (string) (new Completed($this->formEntry))->render()
        ]);
    }
}
