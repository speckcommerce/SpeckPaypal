<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;

class GetBalance extends AbstractRequest
{
    protected $returnAllCurrencies = 0;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('GetBalance');
    }

    /**
     * (Optional) Indicates whether to return all currencies. It is one of the following values:
     *
     * 0 – Return only the balance for the primary currency holding.
     * 1 – Return the balance for each currency holding.
     * NOTE:This field is available since version 51. Prior versions return only the balance for the primary currency holding.
     *
     * @param $returnAllCurrencies
     */
    public function setReturnAllCurrencies($returnAllCurrencies)
    {
        $this->returnAllCurrencies = ($returnAllCurrencies) ? 1 : 0;
    }

    public function getReturnAllCurrencies()
    {
        return $this->returnAllCurrencies;
    }

    public function isValid()
    {
        return true;
    }
}