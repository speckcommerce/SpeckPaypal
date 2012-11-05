<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;

class DoVoid extends AbstractRequest
{
    protected $authorizationId;
    protected $note;
    protected $msgSubId;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('DoVoid');
    }

    /**
     * (Required) Original authorization ID specifying the authorization to void or,
     * to void an order, the order ID.
     *
     * IMPORTANT:If you are voiding a transaction that has been reauthorized, use the ID
     * from the original authorization, and not the reauthorization.
     *
     * @param $authorizationId
     */
    public function setAuthorizationId($authorizationId)
    {
        $this->authorizationId = $authorizationId;
    }

    /**
     * (Optional) A message ID used for idempotence to uniquely identify a message. This ID
     * can later be used to request the latest results for a previous request without generating
     * a new request. Examples of this include requests due to timeouts or errors during the
     * original request.
     *
     * Character length and limitations: 38 single-byte characters
     *
     * @param $msgSubId
     */
    public function setMsgSubId($msgSubId)
    {
        $this->msgSubId = $msgSubId;
    }

    /**
     * (Optional) Informational note about this void that is displayed to the buyer in email
     * and in their transaction history.
     *
     * Character length and limitations: 255 single-byte characters
     * @param $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    public function getAuthorizationId()
    {
        return $this->authorizationId;
    }

    public function getMsgSubId()
    {
        return $this->msgSubId;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function isValid()
    {
        if(empty($this->authorizationId)) {
            return false;
        }

        return true;
    }
}