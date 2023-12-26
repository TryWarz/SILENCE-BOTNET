<?php

class DiscordWebhook {

    private string $webhookUrl;

    public function __construct(string $webhookUrl)
    {
        $this->webhookUrl = $webhookUrl;
    }

    public function sendMessage(string $host, int $port, int $time, string $method, string $username)
    {
        $data = [
            'content' => null,
            'embeds' => [
                [
                    'title' => '📌 Attack Send',
                    'color' => null,
                    'fields' => [
                        [
                            'name' => 'HOST',
                            'value' => '📡 ' . $host,
                            'inline' => false,
                        ],
                        [
                            'name' => 'PORT',
                            'value' => '📪 ' . $port,
                            'inline' => false,
                        ],
                        [
                            'name' => 'TIME',
                            'value' => '⏰ ' . $time,
                            'inline' => false,
                        ],
                        [
                            'name' => 'METHOD',
                            'value' => '💻 ' . $method,
                            'inline' => false,
                        ],
                        [
                            'name' => 'USERNAME',
                            'value' => '👤 ' . $username,
                            'inline' => false,
                        ],
                    ],
                    'image' => [
                        'url' => 'https://cdn.discordapp.com/attachments/1092080055569625218/1153036280440037538/photo_2023-08-29_21-08-54.jpg',
                    ],
                ],
            ],
        ];

        $ch = curl_init($this->webhookUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function sendError(string $apiName, string $response)
    {
        $data = [
            'content' => null,
            'embeds' => [
                [
                    'title' => '📌 Error API',
                    'color' => null,
                    'fields' => [
                        [
                            'name' => 'Api',
                            'value' => '📡 ' . $apiName,
                            'inline' => true,
                        ],
                        [
                            'name' => 'Response',
                            'value' => '📪 ' . $response,
                            'inline' => true,
                        ],
                    ],
                    'image' => [
                        'url' => 'https://media.tenor.com/FRU2yGmIf1YAAAAd/seriously.gif',
                    ],
                ],
            ],
        ];

        $ch = curl_init($this->webhookUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}