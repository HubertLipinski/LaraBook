<?php

namespace App\Notifications;

use App\Notifications\Messages\SmsApiMessageBuilder;

interface SmsApiNotification
{
    public function toSmsApi($notifiable): SmsApiMessageBuilder;
}
