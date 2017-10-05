<?php

namespace MVG\Domains\Users\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserAccountActive
 * @package MVG\Domains\Users\Notifications
 */
class UserAccountActive extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
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
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(app_name())
            ->line(__('user::strings.emails.auth.account_confirmed'))
            ->action(__('user::labels.frontend.auth.login_button'), route('frontend.auth.login'))
            ->line(__('user::strings.emails.auth.thank_you_for_using_app'));
    }
}