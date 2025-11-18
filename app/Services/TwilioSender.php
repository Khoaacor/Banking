<?php
namespace App\Services;

use Twilio\Rest\Client;

class TwilioSender
{
    protected $client;
    protected $from;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
        $this->from = env('TWILIO_FROM');
    }

    /**
     * @param string $to  E.164 format: +84987654321
     * @param string $body
     * @return array
     */
    public function sendSms(string $to, string $body): array
    {
        try {
            $msg = $this->client->messages->create($to, [
                'from' => $this->from,
                'body' => $body
            ]);

            return [
                'success' => true,
                'sid' => $msg->sid,
                'status' => $msg->status,
                'raw' => $msg->toArray()
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
