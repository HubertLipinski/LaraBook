<?php

namespace App\Services\Utils\SmsApi;

use App\Notifications\Messages\SmsApiMessageBuilder;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


class SmsApiService
{
    private Client $client;
    private string $token;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('services.smsapi.url')]);
        $this->token = config('services.smsapi.token');
    }

    /**
     * @param SmsApiMessageBuilder $message
     *
     * @return bool
     */
    public function sendSms(SmsApiMessageBuilder $message): bool
    {
        $requestData = [
            'form_params' => $message->toArray(),
            'headers' => [
                'Authorization' => "Bearer " . $this->token
            ],
        ];

        try {
            $response = $this->client->post('sms.do', $requestData);
            return $response->getStatusCode() === ResponseAlias::HTTP_OK;
        } catch (GuzzleException $exception) {
            \Log::error('SmsApiService@sendSms error: ' . $exception->getMessage());
        }
        return false;
    }
}
