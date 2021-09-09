<?php

namespace App\Notifications;

use App\Channels\SmsApiChannel;
use App\Notifications\Messages\SmsApiMessageBuilder;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserAccountDeletedNotification extends Notification implements SmsApiNotification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function via($notifiable): array
    {
        return [SmsApiChannel::class];
    }

    /**
     * @param $notifiable
     *
     * @return SmsApiMessageBuilder
     */
    public function toSmsApi($notifiable): SmsApiMessageBuilder
    {
        return (new SmsApiMessageBuilder())
            ->setToNumber($notifiable->phone)
            ->setMessage('Twoje konto zostało usunięte');
    }
}
