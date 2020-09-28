<?php

class OAAPIRequest extends OAAPIBase
{
    public $action = 'test';

    public function __construct(OAAPIResponse $response = null)
    {
        if ($response) {
            $this->merge($response);
        }
    }

    public function getParams()
    {
        return $this->data;
    }
}
