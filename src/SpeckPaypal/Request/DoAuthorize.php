<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;

class DoAuthorize extends AbstractRequest
{
    /**
     * Default currently to send with the paypal request
     */
    protected $transactionId;
    protected $currencyCode = 'USD';
    protected $transactionEntity;
    protected $amt;
    protected $msgSubId;


    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('doAuthorization');
    }

    /**
     * (Optional) A 3-character currency code (default is USD).
     */
    public function setCurrencyCode($v)
    {
        $this->currencyCode = $v;

        return $this;
    }

    /**
     * (Required) Value of the order’s transaction identification number returned by PayPal.
     * Character length and limitations: 19 single-byte characters
     */
    public function setTransactionId($id)
    {
        $this->transactionId = $id;

        return $this;
    }

    /**
     * (Optional) Type of transaction to authorize. The only allowable value is Order, which means
     * that the transaction represents a buyer order that can be fulfilled over 29 days.
     */
    public function setTransactionEntity($entity = false)
    {
        if($entity) {
            $this->transactionEntity = 'Order';
        }

        return $this;
    }

    /**
     * (Required) Amount to capture.
     * Character length and limitations: Value is a positive number which cannot
     * exceed $10,000 USD in any currency. It includes no currency symbol. It must have
     * 2 decimal places, the decimal separator must be a period (.), and the optional
     * thousands separator must be a comma (,).
     */
    public function setAmt($amount)
    {
        $this->amt = $amount;

        return $this;
    }

    /**
     * (Optional) A message ID used for idempotence to uniquely identify a message. This ID can later
     * be used to request the latest results for a previous request without generating a new request.
     * Examples of this include requests due to timeouts or errors during the original request.
     *
     * Character length and limitations: string of up to 38 single-byte characters.
     * This field is available since version 92.0.
     *
     */
    public function setMsgSubId($subId)
    {
        $this->msgSubId = $subId;

        return $this;
    }

    public function getAmt()
    {
        return $this->amt;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getMsgSubId()
    {
        return $this->msgSubId;
    }

    public function getTransactionEntity()
    {
        return $this->transactionEntity;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Check the minimum required values for doAuthorization
     *
     * @return bool
     */
    public function isValid()
    {
        if(empty($this->amt) || empty($this->transactionId)) {
            return false;
        }

        return true;
    }
}