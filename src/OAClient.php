<?php

class OAClient extends OAAPIBase
{
    protected $sessionId;
    protected $curlHandle;
    protected $rawResponse;
    protected $debug = true;
    protected $config;
    protected $response;

    public function __construct(OAClientConfig $config = null)
    {
        $this->config = $config ?: new OAClientConfig();
    }

    public function connect($apiToken = '', $apiKey = '', $endpointUrl = '', $portNumber = '', $timeout = '')
    {
        if ($apiToken) {
            $this->config->apiToken = $apiToken;
        }

        if ($apiKey) {
            $this->config->apiKey = $apiKey;
        }

        if ($endpointUrl) {
            $this->config->endpointUrl = $endpointUrl;
        }

        if ($portNumber) {
            $this->config->portNumber = $portNumber;
        }

        if ($timeout) {
            $this->config->timeout = $timeout;
        }

        $connectRequest = new OAConnectRequest();
        $connectRequest->user_api_token = $this->config->apiToken;
        $connectRequest->user_api_key = $this->config->apiKey;

        $response = $this->sendRequest($connectRequest);

        if ($response->success) {
            $this->sessionId = $response->session_id;
        } else {
            $this->sessionId = null;

            throw new RuntimeException($response->error);
        }

        return $response;
    }

    public function disconnect()
    {
        $disconnectRequest = new OADisconnectRequest();
        $response = $this->sendRequest($disconnectRequest);

        if ($response->success) {
            curl_close($this->curlHandle);
        }

        return $response;
    }

    public function withoutAuth($endpointUrl = '', $portNumber = '', $timeout = '')
    {
        if ($endpointUrl) {
            $this->config->endpointUrl = $endpointUrl;
        }

        if ($portNumber) {
            $this->config->portNumber = $portNumber;
        }

        if ($timeout) {
            $this->config->timeout = $timeout;
        }

        return $this;
    }

    public function sendRequest(OAAPIRequest $request)
    {
        $params = $request->getParams();
        $connectUrl = $this->config->endpointUrl . $request->action;

        $fieldPairs = [];
        foreach ($params as $key => $value) {
            $fieldPairs[] = $key . '=' . urlencode($value);
        }
        $queryString = implode('&', $fieldPairs);

        $this->curlHandle = curl_init();

        // Set the URL, POST var count, and POST data
        $options = [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_TIMEOUT => $this->config->timeout,
            CURLOPT_URL => $connectUrl,
            CURLOPT_POST => count($params),
            CURLOPT_POSTFIELDS => $queryString,
            CURLOPT_PORT => $this->config->portNumber,
        ];

        if ($this->sessionId) {
            $options[CURLOPT_COOKIE] = 'PHPSESSID=' . $this->sessionId;
        }

        curl_setopt_array($this->curlHandle, $options);

        $this->response = $this->execCurl();

        if ($this->debug && !$this->response->success) {
            $this->response->postFields = $queryString;
        }

        $body = json_decode($this->response->body);

        if (isset($body->success)) {
            $this->response->success = $this->response->success && $body->success;
        }

        return $this->response;
    }

    protected function execCurl()
    {
        $this->rawResponse = curl_exec($this->curlHandle);

        $error = curl_error($this->curlHandle);

        $response = new OAAPIResponse();

        if ($error) {
            $response->error = $error;

            return $response;
        }

        $response->body = $this->rawResponse;
        $response->httpCode = curl_getinfo($this->curlHandle, CURLINFO_HTTP_CODE);
        $response->lastUrl = curl_getinfo($this->curlHandle, CURLINFO_EFFECTIVE_URL);

        if ($jsonResult = json_decode($response->body)) {
            if ($jsonResult instanceof stdClass) {
                $response->merge($jsonResult);
            } else {
                $response->setRecords($jsonResult);
            }
            $response->success = true;
        } else {
            $response->error = 'Unable to json_decode the response from the server.';
        }

        return $response;
    }
}
