<?php

namespace App\Supports;

use App\Exceptions\ClientErrorException;
use App\Exceptions\ServerErrorException;
use Illuminate\Support\Facades\Http;

trait AuthTrait
{
    /**
     * @throws ServerErrorException
     * @throws ClientErrorException
     */
    public function sendAuthSMS(string $phoneNumber, string $message)
    {
        $sendPhoneNumbers =explode(',', env('SMS_SEND_NO'));
        foreach($sendPhoneNumbers as $adminPhoneNumber) {
            $response = Http::withHeaders(
                [
                    'X-Secret-Key' => env('SMS_SECRET_KEY'),
                    'Content-Type' => 'application/json;charset=UTF-8'
                ]
            )->post('https://api-sms.cloud.toast.com/sms/v3.0/appKeys/'.env('SMS_API_KEY').'/sender/auth/sms',
                [
                    'body' => $message,
                    'sendNo' => $adminPhoneNumber,
                    'recipientList' => [array('recipientNo' => $phoneNumber, 'countryCode' => '82')]
                ]);

            $responseStatusCode = $response->json();
            $resultCode = $responseStatusCode['body']['data']['sendResultList'][0]['resultCode'];
            if($resultCode != 0) {
                if($resultCode == -2019) {
                    throw new ClientErrorException(__('register.phone_auth_confirm.message_server_number_not_valid'));
                }
                throw new ServerErrorException(__('register.phone_auth_confirm.message_server_error'));
            }
        }
    }

    public function sendSMS(string $phoneNumber, string $message)
    {
        $response = Http::withHeaders(
            [
                'X-Secret-Key' => env('SMS_SECRET_KEY'),
                'Content-Type' => 'application/json;charset=UTF-8'
            ]
        )->post('https://api-sms.cloud.toast.com/sms/v3.0/appKeys/'.env('SMS_API_KEY').'/sender/sms',
            [
                'body' => $message,
                'sendNo' =>env('SMS_SEND_NO'),
                'recipientList' => [array('recipientNo' => $phoneNumber, 'countryCode' => '82')]
            ]);

        $responseStatusCode = $response->json();
        $resultCode = $responseStatusCode['body']['data']['sendResultList'][0]['resultCode'];
        if($resultCode != 0) {
            if($resultCode == -2019) {
                throw new ClientErrorException(__('register.phone_auth_confirm.message_server_number_not_valid'));
            }
            throw new ServerErrorException(__('register.phone_auth_confirm.message_server_error'));
        }
    }
}
