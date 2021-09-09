<?php

namespace App\Notifications\Messages;

use Illuminate\Contracts\Support\Arrayable;

class SmsApiMessageBuilder implements Arrayable
{
    private int $toNumber;
    private string $message;
    private string $encoding = 'utf-8';

    /**
     * @param int $toNumber
     *
     * @return SmsApiMessageBuilder
     */
    public function setToNumber(int $toNumber): self
    {
        $this->toNumber = $toNumber;
        return $this;
    }

    /**
     * @param string $message
     *
     * @return SmsApiMessageBuilder
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param string $encoding
     *
     * @return SmsApiMessageBuilder
     */
    public function setEncoding(string $encoding): self
    {
        $this->encoding = $encoding;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'to' => $this->toNumber,
            'message' => $this->message,
            'encoding' => $this->encoding,
        ];
    }
}
