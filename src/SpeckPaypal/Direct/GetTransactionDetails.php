<?php
namespace SpeckPaypal\Direct;

use SpeckPaypal\AbstractModel;

class GetTransactionDetails extends AbstractModel
{
    protected $transactionId;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('getTransactionDetails');
    }

    public function setTransactionId($id)
    {
        $this->transactionId = $id;

        return $this;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function isValid()
    {
        if(empty($this->transactionId)) {
            return false;
        }

        return true;
    }
}