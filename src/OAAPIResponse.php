<?php

class OAAPIResponse extends OAAPIBase
{
    public $postFields = '';
    public $header = '';
    public $body = '';
    public $error = '';
    public $httpCode = '';
    public $lastUrl = '';
    public $success = false;
}
