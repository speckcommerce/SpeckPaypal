<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;
use SpeckPaypal\Element\Address;

class DoDirectPayment extends AbstractRequest
{
    protected $_paymentDetails;
    protected $_address;
    protected $_shipAddress;

    protected $paymentAction = 'Sale';
    protected $cvv2;
    protected $currencyCode = 'USD';
    protected $ipAddress;
    protected $returnFmfDetails;
    protected $creditCardType;
    protected $acct;
    protected $expDate;
    protected $startDate;
    protected $issueNumber;
    protected $firstName;
    protected $lastName;
    protected $email;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('doDirectPayment');
    }

    public function setAddress($address)
    {
        $this->_address = $address;

        return $this;
    }

    public function setShipAddress($address)
    {
        $this->_shipAddress = $address;

        return $this;
    }

    public function setPaymentDetails($details)
    {
        $this->_paymentDetails = $details;

        return $this;
    }

    /**
     * (Required) Credit card number.
     *
     * Character length and limitations: Numeric characters only with no spaces or punctuation.
     * The string must conform with modulo and length required by each credit card type.
     */
    public function setAcct($acct)
    {
        $this->acct = $acct;

        return $this;
    }

    /**
     * Proxy to setAmt
     *
     * @param $v
     * @return Payment
     */
    public function setCardNumber($v)
    {
        $this->setAcct($v);

        return $this;
    }

    public function getCardNumber()
    {
        return $this->acct;
    }

    /**
     * (Optional) Type of credit card. For UK, only Maestro, MasterCard, Discover, and Visa are allowable.
     * For Canada, only MasterCard and Visa are allowable and Interac debit cards are not supported. It
     * is one of the following values:
     *
     *   Visa
     *   MasterCard
     *   Discover
     *   Amex
     *   Maestro: See note.
     *
     * NOTE:If the credit card type is Maestro, you must set CURRENCYCODE to GBP. In addition, you
     * must specify either STARTDATE or ISSUENUMBER.
     *
     * Character length and limitations: Up to 10 single-byte alphabetic characters
     */
    public function setCreditCardType($creditCardType)
    {
        if(!in_array($creditCardType, array('Visa', 'Mastercard', 'Amex', 'Maestro', 'Discover'))) {
            throw new \Exception('Invalid credit card type passed.');
        }
        $this->creditCardType = $creditCardType;

        return $this;
    }

    /**
     * (Optional) A 3-character currency code (default is USD).
     *
     * @param $currencyCode
     * @return Payment
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * Card Verification Value, version 2. Your Merchant Account settings determine whether
     * this field is required. To comply with credit card processing regulations, you must
     * not store this value after a transaction has been completed.
     *
     * Character length and limitations: For Visa, MasterCard, and Discover, the value is exactly
     * 3 digits. For American Express, the value is exactly 4 digits.
     *
     * @param $cvv2
     * @return Payment
     */
    public function setCvv2($cvv2)
    {
        $this->cvv2 = $cvv2;

        return $this;
    }

    /**
     * Credit card expiration date. This field is required if you are using recurring
     * payments with direct payments.
     *
     * Character length and limitations: 6 single-byte alphanumeric characters, including
     * leading zero, in the format MMYYYY
     *
     * @param $expDate
     * @return Payment
     */
    public function setExpDate($expDate)
    {
        $this->expDate = $expDate;

        return $this;
    }

    /**
     * Proxy to setExpDate
     *
     * @param $date
     * @return Payment
     */
    public function setExpirationDate($date)
    {
        $this->setExpDate($date);

        return $this;
    }

    /**
     * (Optional) Email address of buyer.
     * Character length and limitations: 127 single-byte characters
     *
     * @param $email
     * @return Payment
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * (Required) Buyer’s first name.
     * Character length and limitations: 25 single-byte characters
     *
     * @param $firstName
     * @return Payment
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * (Required) Buyer’s last name.
     * Character length and limitations: 25 single-byte characters
     *
     * @param $lastName
     * @return Payment
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * (Required) IP address of the buyer’s browser.
     * NOTE:PayPal records this IP addresses as a means to detect possible fraud.
     *
     * Character length and limitations: 15 single-byte characters, including
     * periods, for example, 255.255.255.255
     *
     * @param $ipAddress
     * @return Payment
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * (Optional) Issue number of Maestro card.
     *
     * Character length and limitations: 2 numeric digits maximum
     *
     * @param $ipAddress
     * @return Payment
     */
    public function setIssueNumber($issueNumber)
    {
        $this->issueNumber = $issueNumber;

        return $this;
    }

    /**
     * (Optional) Flag to indicate whether you want the results returned by Fraud Management
     * Filters. By default, you do not receive this information. It is one of the following
     * values:
     *
     * 0 – Do not receive FMF details (default).
     * 1 – Receive FMF details.
     *
     * @param $returnFmfDetails
     * @return Payment
     */
    public function setReturnFmfDetails($returnFmfDetails)
    {
        $returnFmfDetails = ($returnFmfDetails) ? 1 : 0;
        $this->returnFmfDetails = $returnFmfDetails;

        return $this;
    }

    /**
     * (Optional) Month and year that Maestro card was issued.
     *
     * Character length and limitations: Must be 6 digits, including leading zero, in the format MMYYYY
     *
     * @param $startDate
     * @return Payment
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getAddress()
    {
        return $this->_address;
    }

    public function getPaymentDetails()
    {
        return $this->_paymentDetails;
    }

    public function getShipAddress()
    {
        return $this->_shipAddress;
    }

    public function getAcct()
    {
        return $this->acct;
    }

    public function getCreditCardType()
    {
        return $this->creditCardType;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function getCvv2()
    {
        return $this->cvv2;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getExpDate()
    {
        return $this->expDate;
    }

    public function getExpirationDate()
    {
        return $this->getExpDate();
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    public function getIssueNumber()
    {
        return $this->issueNumber;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPaymentAction()
    {
        return $this->paymentAction;
    }

    public function getReturnFmfDetails()
    {
        return $this->returnFmfDetails;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Validate the minimum set of required values for doDirectPayment
     *
     * @return bool
     */
    public function isValid()
    {
        //validate directPayment values
        $checkEmpty = array($this->ipAddress, $this->acct, $this->firstName, $this->lastName);

        if(!$this->checkEmpty($checkEmpty) || is_null($this->_address)) {
            return false;
        }

        //address fields
        $address = $this->_address;

        $test = array(
            $address->getStreet(),
            $address->getCity(),
            $address->getState(),
            $address->getCountryCode(),
            $address->getZip()
        );

        if(!$this->checkEmpty($test) || is_null($this->_paymentDetails)) {
            return false;
        }

        $amt = $this->_paymentDetails->getAmt();
        if(empty($amt)) {
            return false;
        }

        //payment details payment action cannot be order
        if($this->_paymentDetails->getPaymentAction() == "Order") {
            return false;
        }

        return true;
    }

    public function toArray()
    {
        $data = parent::toArray();

        $data = array_merge($data, $this->_paymentDetails->toArray());

        if(!is_null($this->_address)) {
            //get address
            $address = $this->_address->toArray();
            if(isset($address['PHONENUM'])) {
                $address['SHIPTOPHONENUM'] = $address['PHONENUM'];
                unset($address['PHONENUM']);
            }
            $data = array_merge($data, $address);
        }

        if(!is_null($this->_shipAddress)) {
            $shipAddress = $this->_shipAddress->toArray();
            $tmp = array();
            foreach($shipAddress as $key => $value) {
                $tmp["SHIPTO{$key}"] = $value;
            }
            $data = array_merge($data, $tmp);
        }

        return $data;
    }
}