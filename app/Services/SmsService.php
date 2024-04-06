<?php

namespace App\Services;

use App\Repositories\UserRepository;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class SmsService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function send(int $userId): bool
    {
        $user = $this->userRepository->getDetail($userId);

        $smsProviderUrl = config('app.sms.url');

        $client = new Client;
        $response = $client->request('GET', $smsProviderUrl, [
            'form_params' => [
                'phone' => $user->phone,
                'message' => 'Thank you for your submission',
            ],
        ]);

        if ($response->getStatusCode() === Response::HTTP_OK) {
            return true;
        }

        return false;
    }
}
