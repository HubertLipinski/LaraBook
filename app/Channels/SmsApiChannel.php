<?php

namespace App\Channels;

use App\Notifications\SmsApiNotification;
use App\Services\Utils\SmsApi\SmsApiService;

class SmsApiChannel
{
    private SmsApiService $smsApiService;

    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct(SmsApiService $smsApiService)
    {
        $this->smsApiService = $smsApiService;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param SmsApiNotification $notification
     *
     * @return void
     */
    public function send($notifiable, SmsApiNotification $notification)
    {
        $message = $notification->toSmsApi($notifiable);
        $this->smsApiService->sendSms($message);
    }
}
