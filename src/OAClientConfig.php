<?php

class OAClientConfig
{
    // These are the base parameters which should be provided by any subclass, as they
    // represent the minimum required fields to establish an API connection using OAClient

    // While its certainly possible to simply hard code the values here, we recommend that
    // the values be stored in an INI file (using OAClientConfigIni to load them), a database
    // (using another custom subclass to load them), and possibly even encrypted (using a
    // subclass implementation to decrypt on loading the values).

    public $endpointUrl; // Make sure the endpoint is the server your account is on
    public $portNumber; // Due to CURL requirements, port number should not be included in the endpoint URL
    // CURL uses the default port for the scheme (http/https), so this an optional setting
    public $apiToken;   // Api Token
    public $apiKey;     // Api Key
    public $timeout = 50; // For CURL
}
