<?php

namespace Shopper\Framework\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminSendCredentials extends Notification
{
    /**
     * Password Attribute.
     *
     * @var string
     */
    public $password;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(__('Welcome to Shopper'))
            ->greeting("Hello {$notifiable->full_name}")
            ->line(__('An account has been created for you as Administrator on the website ') . env('APP_URL'))
            ->line("Email: {$notifiable->email} - Password: {$this->password}")
            ->line(__('You can use the following link to login:'))
            ->action('Login', route('shopper.login'))
            ->line(__('After logging in you need to change your password by clicking on your name in the upper right corner of the admin area'));
    }
}
