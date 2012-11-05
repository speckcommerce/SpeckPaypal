<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;

class DoCapture extends AbstractRequest
{
    const COMPLETE                  = "Complete";
    const NOT_COMPLETE              = "NotComplete";

    protected $currencyCode = 'USD';
    protected $authorizationId;
    protected $amt;
    protected $completeType = 'Complete';
    protected $invoiceNumber;
    protected $note;
    protected $softDescriptor;
    protected $msgSubId;


    /**
     * TransactionId received from doDirectPayment
     * Amount is the amount of funds to capture
     *
     * @param $transactionId
     * @param $amount
     */
    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('doCapture');
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
     * (Required) Authorization identification number of the payment you want
     * to capture. This is the transaction ID returned from DoExpressCheckoutPayment,
     * DoDirectPayment, or CheckOut. For point-of-sale transactions, this is the
     * transaction ID returned by the CheckOut call when the payment action is Authorization.
     * Character length and limitations: 19 single-byte characters maximum
     */
    public function setAuthorizationId($id)
    {
        $this->authorizationId = $id;

        return $this;
    }

    public function setTransactionId($id)
    {
        $this->setAuthorizationId($id);

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
     * (Required) Indicates whether or not this is your last capture. It is one of the
     * following values:
     *
     * Complete – This is the last capture you intend to make.
     * NotComplete – You intend to make additional captures.
     *
     * NOTE:If Complete, any remaining amount of the original authorized transaction is
     * automatically voided and all remaining open authorizations are voided.
     */
    public function setCompleteType($type)
    {
        if(!in_array($type, array(self::COMPLETE, self::NOT_COMPLETE))) {
            throw new \Exception("Invalid complete type");
        }

       $this->completeType = $type;

        return $this;
    }

    /**
     * (Optional) Your invoice number or other identification number that is displayed to
     * you and to the buyer in their transaction history. The value is recorded only if the
     * authorization you are capturing is an Express Checkout order authorization.
     *
     * NOTE:This value on DoCapture overwrites a value previously set on DoAuthorization.
     * Character length and limitations: 127 single-byte alphanumeric characters
     */
    public function setInvoiceNumber($number)
    {
        $this->invoiceNumber = $number;

        return $this;
    }

    /**
     *
     * (Optional) An informational note about this settlement that is displayed to the
     * buyer in email and in their transaction history.
     * Character length and limitations: 255 single-byte characters
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * (Optional) Per transaction description of the payment that is passed to the
     * buyer’s credit card statement. If you provide a value in this field, the full
     * descriptor displayed on the buyer’s statement has the following format:
     * <PP * | PAYPAL *><Merchant descriptor as set in the Payment Receiving Preferences><1 space><soft descriptor>
     * Character length and limitations: The soft descriptor can contain only the following characters:
     *
     * Alphanumeric characters
     * - (dash)
     * * (asterisk)
     * . (period)
     *  {space}
     * If you pass any other characters (such as “,”), PayPal returns an error code.
     * The soft descriptor does not include the phone number, which can be toggled between your customer
     * service number and PayPal’s Customer Service number.
     * The maximum length of the soft descriptor is 22 characters. Of this, the PayPal prefix uses either
     * 4 or 8 characters of the data format. Thus, the maximum length of the soft descriptor information
     * that you can pass in this field is:
     *
     * 22 - len(<PP * | PAYPAL *>) - len(<Descriptor set in Payment Receiving Preferences> + 1)
     * For example, assume the following conditions:
     *
     * The PayPal prefix toggle is set to PAYPAL * in PayPal’s administration tools.
     * The merchant descriptor set in the Payment Receiving Preferences is set to EBAY.
     * The soft descriptor is passed in as JanesFlowerGifts LLC.
     * The resulting descriptor string on the credit card is:
     * PAYPAL *EBAY JanesFlow
     */
    public function setSoftDescriptor($descriptor)
    {
        $this->softDescriptor = $descriptor;

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

    public function getAuthorizationId()
    {
        return $this->authorizationId;
    }

    public function getCompleteType()
    {
        return $this->completeType;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getMsgSubId()
    {
        return $this->msgSubId;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getSoftDescriptor()
    {
        return $this->softDescriptor;
    }

    public function getTransactionId()
    {
        return $this->getAuthorizationId();
    }

    public function isValid()
    {
        $test = array($this->authorizationId, $this->amt, $this->completeType);

        return $this->checkEmpty($test);
    }
}