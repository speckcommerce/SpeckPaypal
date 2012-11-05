<?php
namespace SpeckPaypal\Element;

use SpeckPaypal\Element\AbstractElement;

class PaymentDetails extends AbstractElement
{
    const SALE              = "Sale";
    const AUTHORIZATION     = "Authorization";
    const ORDER             = "Order";

    protected $_prefix;
    protected $_items;
    protected $_address;
    /*
     * @todo add ebay items support
     */
    protected $_ebayItems;

    protected $sellerPaypalAccountId;
    protected $amt;
    protected $currencyCode = 'USD';
    protected $itemAmt;
    protected $shippingAmt;
    protected $insuranceAmt;
    protected $shipDiscAmt;
    protected $insuranceOptionOffered;
    protected $handlingAmt;
    protected $taxAmt;
    protected $desc;
    protected $custom;
    protected $invNum;
    protected $notifyUrl;
    protected $noteText;
    protected $transactionId;
    protected $allowedPaymentMethod;
    protected $paymentAction;
    protected $paymentRequestId;
    protected $paymentReason;
    protected $buttonSource;
    protected $recurring;

    /**
     * (Optional) Indicates whether insurance is available as an option the buyer can choose on the
     * PayPal Review page. You can specify up to 10 payments, where n is a digit between 0 and 9,
     * inclusive. Is one of the following values:
     *
     * true – The Insurance option displays the string ‘Yes’ and the insurance amount. If true, the
     * total shipping insurance for this order must be a positive number.
     *
     * false – The Insurance option displays ‘No.’
     */
    public function setInsuranceOptionOffered($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->insuranceOptionOffered = $val;

        return $this;
    }

    public function setPrefix($index)
    {
        $this->_prefix = $index;

        return $this;
    }

    public function setAddress($address)
    {
        $this->_address = $address;

        return $this;
    }

    public function setItems($items)
    {
        $this->_items = $items;

        return $this;
    }

    public function setEbayItems($ebayItems)
    {
        $this->_ebayItems = $ebayItems;

        return $this;
    }

    /**
     * (Optional) The payment method type. Specify the value InstantPaymentOnly. You can specify up to
     * 10 payments, where n is a digit between 0 and 9, inclusive.
     */
    public function setAllowedPaymentMethod($allowedPaymentMethod)
    {
        $this->allowedPaymentMethod = $allowedPaymentMethod;

        return $this;
    }

    /**
     * (Required) Total cost of the transaction to the buyer. If shipping cost and tax
     * charges are known, include them in this value. If not, this value should be the
     * current sub-total of the order. If the transaction includes one or more one-time
     * purchases, this field must be equal to the sum of the purchases. Set this field to
     * 0 if the transaction does not include a one-time purchase such as when you set up a
     * billing agreement for a recurring payment that is not immediately charged. When the
     * field is set to 0, purchase-specific fields are ignored. You can specify up to 10 payments,
     * where n is a digit between 0 and 9, inclusive; except for digital goods, which supports
     * single payments only.
     *
     * Character length and limitations: Value is a positive number which cannot exceed $10,000 USD
     * in any currency. It includes no currency symbol. It must have 2 decimal places, the decimal
     * separator must be a period (.), and the optional thousands separator must be a comma (,).
     */
    public function setAmt($amt)
    {
        $this->amt = $amt;

        return $this;
    }

    /**
     * (Optional) An identification code for use by third-party applications to identify transactions.
     * Character length and limitations: 32 single-byte alphanumeric characters
     */
    public function setButtonSource($buttonSource)
    {
        $this->buttonSource = $buttonSource;

        return $this;
    }

    /**
     * (Optional) A 3-character currency code (default is USD). You can specify up to 10 payments,
     * where n is a digit between 0 and 9, inclusive; except for digital goods, which supports
     * single payments only.
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * (Optional) A free-form field for your own use. You can specify up to 10 payments, where n
     * is a digit between 0 and 9, inclusive.
     *
     * NOTE:The value you specify is available only if the transaction includes a purchase.
     * This field is ignored if you set up a billing agreement for a recurring payment that
     * is not immediately charged.
     *
     * Character length and limitations: 256 single-byte alphanumeric characters
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;

        return $this;
    }

    /**
     * (Optional) Description of items the buyer is purchasing. You can specify up to 10 payments,
     * where n is a digit between 0 and 9, inclusive; except for digital goods, which supports
     * single payments only.
     *
     * NOTE:The value you specify is available only if the transaction includes a purchase. This
     * field is ignored if you set up a billing agreement for a recurring payment that is not
     * immediately charged.
     *
     * Character length and limitations: 127 single-byte alphanumeric characters
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * (Optional) Total handling costs for this order. You can specify up to 10 payments, where n
     * is a digit between 0 and 9, inclusive.
     *
     * NOTE:If you specify a value for PAYMENTREQUEST_n_HANDLINGAMT, you must also specify a value
     * for PAYMENTREQUEST_n_ITEMAMT.
     *
     * Character length and limitations: Value is a positive number which cannot exceed $10,000 USD
     * in any currency. It includes no currency symbol. It must have 2 decimal places, the decimal
     * separator must be a period (.), and the optional thousands separator must be a comma (,).
     */
    public function setHandlingAmt($handlingAmt)
    {
        $this->handlingAmt = $handlingAmt;

        return $this;
    }

    /**
     * (Optional) Total shipping insurance costs for this order. The value must be a non-negative
     * currency amount or null if insurance options are offered. You can specify up to 10 payments,
     * where n is a digit between 0 and 9, inclusive.
     *
     * Character length and limitations: Value is a positive number which cannot exceed $10,000 USD
     * in any currency. It includes no currency symbol. It must have 2 decimal places, the decimal
     * separator must be a period (.), and the optional thousands separator must be a comma (,).
     */
    public function setInsuranceAmt($insuranceAmt)
    {
        $this->insuranceAmt = $insuranceAmt;

        return $this;
    }

    /**
     * (Optional) Your own invoice or tracking number.You can specify up to 10 payments, where n
     * is a digit between 0 and 9, inclusive; except for digital goods, which supports single
     * payments only.
     *
     * NOTE:The value you specify is available only if the transaction includes a purchase. This
     * field is ignored if you set up a billing agreement for a recurring payment that is not
     * immediately charged.
     *
     * Character length and limitations: 256 single-byte alphanumeric characters
     */
    public function setInvNum($invNum)
    {
        $this->invNum = $invNum;

        return $this;
    }

    /**
     * Sum of cost of all items in this order. For digital goods, this field is required. You can
     * specify up to 10 payments, where n is a digit between 0 and 9, inclusive; except for
     * digital goods, which supports single payments only.
     *
     * NOTE:PAYMENTREQUEST_n_ITEMAMT is required if you specify L_PAYMENTREQUEST_n_AMTm .
     *
     * Character length and limitations: Value is a positive number which cannot exceed
     * $10,000 USD in any currency. It includes no currency symbol. It must have 2 decimal places,
     * the decimal separator must be a period (.), and the optional thousands separator
     * must be a comma (,).
     */
    public function setItemAmt($itemAmt)
    {
        $this->itemAmt = $itemAmt;

        return $this;
    }

    /**
     * (Optional) Note to the merchant. You can specify up to 10 payments, where n is a digit
     * between 0 and 9, inclusive.
     *
     * Character length and limitations: 255 single-byte characters
     */
    public function setNoteText($noteText)
    {
        $this->noteText = $noteText;

        return $this;
    }

    /**
     * (Optional) Your URL for receiving Instant Payment Notification (IPN) about this transaction.
     * If you do not specify this value in the request, the notification URL from your Merchant
     *
     * Profile is used, if one exists.You can specify up to 10 payments, where n is a digit between
     * 0 and 9, inclusive; except for digital goods, which supports single payments only.
     *
     * IMPORTANT:The notify URL applies only to DoExpressCheckoutPayment. This value is ignored when
     * set in SetExpressCheckout or GetExpressCheckoutDetails.
     *
     * Character length and limitations: 2,048 single-byte alphanumeric characters
     */
    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;

        return $this;
    }

    /**
     * How you want to obtain payment. When implementing parallel payments, this field is required
     * and must be set to Order. When implementing digital goods, this field is required and must
     * be set to Sale. You can specify up to 10 payments, where n is a digit between 0 and 9,
     * inclusive; except for digital goods, which supports single payments only. If the transaction
     * does not include a one-time purchase, this field is ignored. It is one of the following values:
     *
     * Sale – This is a final sale for which you are requesting payment (default).
     *
     * Authorization – This payment is a basic authorization subject to settlement with
     * PayPal Authorization and Capture.
     *
     * Order – This payment is an order authorization subject to settlement with PayPal
     * Authorization and Capture.
     *
     * NOTE:You cannot set this field to Sale in SetExpressCheckout request and then change the value
     * to Authorization or Order in the DoExpressCheckoutPayment request. If you set the field to
     * Authorization or Order in SetExpressCheckout, you may set the field to Sale.
     *
     * Character length and limitations: Up to 13 single-byte alphabetic characters
     */
    public function setPaymentAction($paymentAction)
    {
        if(!in_array($paymentAction, array(self::AUTHORIZATION, self::SALE, self::ORDER))) {
            throw new \Exception("Invalid payment action value passed.");
        }
        $this->paymentAction = $paymentAction;

        return $this;
    }

    /**
     * Indicates the type of transaction. It is one of the following values:
     *
     * None – Transaction is not identified as a particular type.
     * Refund – Identifies the transaction as a refund.
     */
    public function setPaymentReason($paymentReason)
    {
        if(!in_array($paymentReason, array("None", "Refund"))) {
            throw new \Exception("Invalid value for payment reason passed.");
        }
        $this->paymentReason = $paymentReason;

        return $this;
    }

    /**
     * A unique identifier of the specific payment request, which is required for parallel payments.
     * You can specify up to 10 payments, where n is a digit between 0 and 9, inclusive.
     *
     * Character length and limitations: Up to 127 single-byte characters
     */
    public function setPaymentRequestId($paymentRequestId)
    {
        $this->paymentRequestId = $paymentRequestId;

        return $this;
    }

    /**
     * ns:RecurringFlagType
     *
     * (Optional) Flag to indicate a recurring transaction. It is one of the following values:
     *
     * Any value other than Y – This is not a recurring transaction (default).
     * Y – This is a recurring transaction.
     *
     * NOTE:To pass Y in this field, you must have established a billing agreement with the buyer
     * specifying the amount, frequency, and duration of the recurring payment.
     */
    public function setRecurring($recurring)
    {
        $this->recurring = ($recurring) ? 'Y' : 'N';

        return $this;
    }

    /**
     * Unique identifier for the merchant. For parallel payments, this field is required and
     * must contain the Payer Id or the email address of the merchant. You can specify up to
     * 10 payments, where n is a digit between 0 and 9, inclusive.
     *
     * Character length and limitations: 127 single-byte alphanumeric characters
     */
    public function setSellerPaypalAccountId($sellerPaypalAccountId)
    {
        $this->sellerPaypalAccountId = $sellerPaypalAccountId;

        return $this;
    }

    /**
     * (Optional) Shipping discount for this order, specified as a negative number. You can specify
     * up to 10 payments, where n is a digit between 0 and 9, inclusive.
     *
     * Character length and limitations: Value is a positive number which cannot exceed $10,000 USD
     * in any currency. It includes no currency symbol. It must have 2 decimal places, the decimal
     * separator must be a period (.), and the optional thousands separator must be a comma (,).
     */
    public function setShipDiscAmt($shipDiscAmt)
    {
        $this->shipDiscAmt = $shipDiscAmt;

        return $this;
    }

    /**
     * (Optional) Total shipping costs for this order. You can specify up to 10 payments,
     * where n is a digit between 0 and 9, inclusive.
     *
     * NOTE:If you specify a value for PAYMENTREQUEST_n_SHIPPINGAMT, you must also specify a
     * value for PAYMENTREQUEST_n_ITEMAMT.
     *
     * Character length and limitations: Value is a positive number which cannot exceed $10,000 USD
     * in any currency. It includes no currency symbol. It must have 2 decimal places, the decimal
     * separator must be a period (.), and the optional thousands separator must be a comma (,).
     */
    public function setShippingAmt($shippingAmt)
    {
        $this->shippingAmt = $shippingAmt;

        return $this;
    }

    /**
     * (Optional) Sum of tax for all items in this order. You can specify up to 10 payments, where
     * n is a digit between 0 and 9, inclusive; except for digital goods, which supports single
     * payments only.
     *
     * NOTE:PAYMENTREQUEST_n_TAXAMT is required if you specify L_PAYMENTREQUEST_n_TAXAMTm
     *
     * Character length and limitations: Value is a positive number which cannot exceed $10,000
     * USD in any currency. It includes no currency symbol. It must have 2 decimal places, the
     * decimal separator must be a period (.), and the optional thousands separator must be a comma (,).
     */
    public function setTaxAmt($taxAmt)
    {
        $this->taxAmt = $taxAmt;

        return $this;
    }

    /**
     * (Optional) Transaction identification number of the transaction that was created.
     * You can specify up to 10 payments, where n is a digit between 0 and 9, inclusive.
     *
     * NOTE:This field is only returned after a successful transaction for DoExpressCheckout has occurred.
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    public function getAddress()
    {
        return $this->_address;
    }

    public function getEbayItems()
    {
        return $this->_ebayItems;
    }

    public function getItems()
    {
        return $this->_items;
    }

    public function getPrefix()
    {
        return $this->_prefix;
    }

    public function getAllowedPaymentMethod()
    {
        return $this->allowedPaymentMethod;
    }

    public function getAmt()
    {
        return $this->amt;
    }

    public function getButtonSource()
    {
        return $this->buttonSource;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function getCustom()
    {
        return $this->custom;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function getHandlingAmt()
    {
        return $this->handlingAmt;
    }

    public function getInsuranceAmt()
    {
        return $this->insuranceAmt;
    }

    public function getInsuranceOptionOffered()
    {
        return $this->insuranceOptionOffered;
    }

    public function getInvNum()
    {
        return $this->invNum;
    }

    public function getItemAmt()
    {
        return $this->itemAmt;
    }

    public function getNoteText()
    {
        return $this->noteText;
    }

    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    public function getPaymentAction()
    {
        return $this->paymentAction;
    }

    public function getPaymentReason()
    {
        return $this->paymentReason;
    }

    public function getPaymentRequestId()
    {
        return $this->paymentRequestId;
    }

    public function getRecurring()
    {
        return $this->recurring;
    }

    public function getSellerPaypalAccountId()
    {
        return $this->sellerPaypalAccountId;
    }

    public function getShipDiscAmt()
    {
        return $this->shipDiscAmt;
    }

    public function getShippingAmt()
    {
        return $this->shippingAmt;
    }

    public function getTaxAmt()
    {
        return $this->taxAmt;
    }

    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * This method will change array keys based on $prefix if set.
     *
     * This is needed for the difference in keys for Payment and SetExpressCheckout
     *
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();

        $prefix = ($this->_prefix) ? $this->_prefix : "";
        if(!empty($prefix)) {
            $olddata = $data;
            $data = array();
            foreach($olddata as $key => $value) {
                $data[$prefix . $key] = $value;
            }
        }

        //address
        if(!is_null($this->_address)) {
            $address = $this->_address->toArray();
            $tmp = array();
            foreach($address as $key => $value) {
                $tmp["{$prefix}{$key}"] = $value;
            }
            $data = array_merge($data, $tmp);
        }

        //items
        if(is_array($this->_items)) {
            $i = 0;
            foreach($this->_items as $item) {
                $tmp = array();
                $itemArray = $item->toArray();
                foreach($itemArray as $key => $value) {
                    $tmp["L_{$prefix}{$key}{$i}"] = $value;

                }
                $data = array_merge($data, $tmp);
                $i++;
            }
        }
        //ebay

        return $data;
    }
}
