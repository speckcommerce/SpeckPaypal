<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;

class GetExpressCheckoutDetails extends AbstractRequest
{
    protected $token;
    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('getExpressCheckoutDetails');
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function isValid()
    {
        if(empty($this->token)) {
            return false;
        }

        return true;
    }
}