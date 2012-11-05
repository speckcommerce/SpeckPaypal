<?php
namespace SpeckPaypal\Request;

use \SpeckPaypal\Request\AbstractRequest;

class RefundTransaction extends AbstractRequest
{

    const FULL = "Full";
    const PARTIAL = "Partial";
    const DISPUTE = "ExternalDispute";
    const OTHER = "Other";

    const SOURCE_ANY = "any";
    const SOURCE_ECHECK = "eCheck";
    const SOURCE_DEFAULT = "default";
    const SOURCE_INSTANT = "instant";

    protected $transactionId;
    protected $payerId;
    protected $invoiceId;
    protected $refundType;
    protected $amt;
    protected $currencyCode;
    protected $note;
    protected $retryUntil;
    protected $refundSource;
    protected $merchantStoreDetails;
    protected $refundAdvice;
    protected $refundItemDetails;
    protected $msgSubId;
    protected $storeId;
    protected $terminalId;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('RefundTransaction');
    }

    /**
     * (Optional) Refund amount. The amount is required if RefundType is Partial
     * NOTE:If RefundType is Full, do not set the amount.
     *
     * Character length and limitations: Value is a positive number which cannot exceed
     * $10,000 USD in any currency. It includes no currency symbol. It must have 2 decimal
     * places, the decimal separator must be a period (.), and the optional thousands
     * separator must be a comma (,).
     *
     * @param $amt
     * @return RefundTransaction
     */
    public function setAmt($amt)
    {
        $this->amt = $amt;

        return $this;
    }

    /**
     * ISO 4217 3-letter currency code. USD for US Dollars. This field is required for partial
     * refunds, and is also required for refunds greater than 100%.
     *
     * Character length and limitations: 3 single-byte characters
     *
     * @param $currencyCode
     * @return RefundTransaction
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * (Optional) Your own invoice or tracking number.
     * Character length and limitations: 127 single-byte alphanumeric characters
     *
     * @param $invoiceId
     * @return RefundTransaction
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * (Optional) Information about the merchant store.
     *
     * @param $merchantStoreDetails
     * @return RefundTransaction
     */
    public function setMerchantStoreDetails($merchantStoreDetails)
    {
        $this->merchantStoreDetails = $merchantStoreDetails;

        return $this;
    }

    /**
     * (Optional) A message ID used for idempotence to uniquely identify a message. This ID can later be
     * used to request the latest results for a previous request without generating a new request.
     * Examples of this include requests due to timeouts or errors during the original request.
     *
     * Character length and limitations: string of up to 38 single-byte characters.
     *
     * @param $msgSubId
     * @return RefundTransaction
     */
    public function setMsgSubId($msgSubId)
    {
        $this->msgSubId = $msgSubId;

        return $this;
    }

    /**
     * (Optional) Custom memo about the refund.
     *
     * Character length and limitations: 255 single-byte alphanumeric characters
     *
     * @param $note
     * @return RefundTransaction
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * (Optional) Encrypted PayPal customer account identification number.
     *
     * NOTE:Either the transaction ID or the payer ID must be specified.
     * Character length and limitations: 127 single-byte alphanumeric characters
     *
     * @param $payerId
     * @return RefundTransaction
     */
    public function setPayerId($payerId)
    {
        $this->payerId = $payerId;

        return $this;
    }

    /**
     * (Optional) Flag to indicate that the buyer was already given store credit for a given
     * transaction. It is one of the following values:
     *
     * true     – The buyer was already given store credit for a given transaction.
     * false    – The buyer was not given store credit for a given transaction.
     *
     * @param $refundAdvice
     * @return RefundTransaction
     */
    public function setRefundAdvice($refundAdvice)
    {
        $this->refundAdvice = ($refundAdvice) ? 'true' : 'false';

        return $this;
    }

    /**
     * (Optional) Details about the individual items to be returned.
     *
     * @param $refundItemDetails
     * @return RefundTransaction
     */
    public function setRefundItemDetails($refundItemDetails)
    {
        $this->refundItemDetails = $refundItemDetails;

        return $this;
    }

    /**
     * (Optional)Type of PayPal funding source (balance or eCheck) that can be used for auto refund.
     * It is one of the following values:
     *
     * any      – The merchant does not have a preference. Use any available funding source.
     * default  – Use the merchant’s preferred funding source, as configured in the merchant’s profile.
     * instant  – Use the merchant’s balance as the funding source.
     * eCheck   – The merchant prefers using the eCheck funding source. If the merchant’s PayPal
     *            balance can cover the refund amount, use the PayPal balance.
     *
     * NOTE:This field does not apply to point-of-sale transactions.
     *
     * @param $refundSource
     * @return RefundTransaction
     */
    public function setRefundSource($refundSource)
    {
        if(!in_array($refundSource, array(self::SOURCE_ANY, self::SOURCE_DEFAULT, self::SOURCE_ECHECK, self::SOURCE_INSTANT))) {
            throw new \Exception('Invalid refund source passed.');
        }

        $this->refundSource = $refundSource;

        return $this;
    }

    /**
     * Type of refund you are making. It is one of the following values:
     *
     * Full – Full refund (default).
     * Partial – Partial refund.
     * ExternalDispute – External dispute.
     * Other – Other type of refund.
     *
     * @param $refundType
     * @return RefundTransaction
     */
    public function setRefundType($refundType)
    {
        if(!in_array($refundType, array(self::DISPUTE, self::FULL, self::PARTIAL, self::OTHER))) {
            throw new \Exception('Invalid refund type passed.');
        }

        $this->refundType = $refundType;

        return $this;
    }

    /**
     * (Optional) Maximum time until you must retry the refund.
     *
     * NOTE:This field does not apply to point-of-sale transactions.
     *
     * @param $retryUntil
     * @return RefundTransaction
     */
    public function setRetryUntil($retryUntil)
    {
        $this->retryUntil = $retryUntil;

        return $this;
    }

    /**
     * Identifier of the merchant store at which the refund is given. This field is required for
     * point-of-sale transactions.
     *
     * Character length and limitations: 50 single-byte characters
     *
     * @param $storeId
     * @return RefundTransaction
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;

        return $this;
    }

    /**
     * (Optional) ID of the terminal.
     *
     * Character length and limitations: 50 single-byte characters
     *
     * @param $terminalId
     * @return RefundTransaction
     */
    public function setTerminalId($terminalId)
    {
        $this->terminalId = $terminalId;

        return $this;
    }

    /**
     * (Optional) Unique identifier of the transaction to be refunded.
     *
     * NOTE:Either the transaction ID or the payer ID must be specified.
     * Character length and limitations: 17 single-byte alphanumeric characters
     *
     * @param $transactionId
     * @return RefundTransaction
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

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

    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    public function getMerchantStoreDetails()
    {
        return $this->merchantStoreDetails;
    }

    public function getMsgSubId()
    {
        return $this->msgSubId;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getPayerId()
    {
        return $this->payerId;
    }

    public function getRefundAdvice()
    {
        return $this->refundAdvice;
    }

    public function getRefundItemDetails()
    {
        return $this->refundItemDetails;
    }

    public function getRefundSource()
    {
        return $this->refundSource;
    }

    public function getRefundType()
    {
        return $this->refundType;
    }

    public function getRetryUntil()
    {
        return $this->retryUntil;
    }

    public function getStoreId()
    {
        return $this->storeId;
    }

    public function getTerminalId()
    {
        return $this->terminalId;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    public function isValid()
    {
        if(empty($this->transactionId) && empty($this->payerId)) {
            return false;
        }

        //if refund type is partial than amount is required
        if($this->refundType == self::PARTIAL && empty($this->amt)) {
            return false;
        }

        return true;
    }
}