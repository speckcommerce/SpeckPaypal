<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;

class TransactionSearch extends AbstractRequest
{
    protected $startDate;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('TransactionSearch');
    }
    
    public function setStartDate($value) {
        $this->startDate = $value;
        return $this;
    }
    public function getStartDate() {
        return $this->startDate;
    }

    public function isValid()
    {
        return true;
    }
}
