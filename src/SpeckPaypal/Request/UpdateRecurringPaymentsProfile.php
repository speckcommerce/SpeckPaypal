<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;
use SpeckPaypal\Element\Address;

class UpdateRecurringPaymentsProfile extends AbstractRequest
{
    protected $_address;
    protected $_shipAddress;

    protected $profileId;
    protected $note;
    protected $desc;
    protected $subscriberName;
    protected $profileReference;
    protected $additionalBillingCycles;
    protected $outstandingAmt;
    protected $autoBillOutAmt;
    protected $maxFailedPayments;
    protected $profileStartDate;

    /* Billing Period Details */
    protected $totalBillingCycles;
    protected $amt;
    protected $trialTotalBillingCycles;
    protected $trialAmt;
    protected $currencyCode = 'USD';
    protected $shippingAmt;
    protected $taxAmt;

    /* Credit Card Details */
    protected $creditCardType;
    protected $acct;
    protected $expDate;
    protected $cvv2;
    protected $startDate;
    protected $issueNumber;

    /* Payer Information */
    protected $email;
    protected $firstName;
    protected $lastName;


    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('UpdateRecurringPaymentsProfile');
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

    /**
     * (Required) Recurring payments profile ID returned in the
     * CreateRecurringPaymentsProfile response. 19-character profile IDs are
     * supported for compatibility with previous versions of the PayPal API.
     * Character length and limitations: 14 single-byte alphanumeric characters
     *
     * @param $profileId
     * @return Payment
     */
    public function setProfileId($profileId)
    {
        $this->profileId = $profileId;

        return $this;
    }

    /**
     * (Optional) The reason for the change in status. For profiles created using
     * Express Checkout, this message is included in the email notification to
     * the buyer when the status of the profile is successfully changed, and can
     * also be seen by both you and the buyer on the Status History page.
     *
     * @param $profileId
     * @return Payment
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * (Required) Description of the recurring payment.
     * Character length and limitations: 127 single-byte alphanumeric characters
     * You must ensure that this field matches the corresponding billing agreement
     * description included in the SetExpressCheckout request.
     *
     * @param $desc
     * @return Payment
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * (Optional) Full name of the person receiving the product or service paid
     * for by the recurring payment. If not present, the name in the buyer's PayPal
     * account is used.Character length and limitations: 32 single-byte characters
     *
     * @param $subscriberName
     * @return Payment
     */
    public function setSubscriberName($subscriberName)
    {
        $this->subscriberName = $subscriberName;

        return $this;
    }

    /**
     * (Optional) The merchant's own unique reference or invoice number.
     * Character length and limitations: 127 single-byte alphanumeric characters
     *
     * @param $profileReference
     * @return Payment
     */
    public function setProfileReference($profileReference)
    {
        $this->profileReference = $profileReference;

        return $this;
    }

   /**
    * (Optional) The number of additional billing cycles to add to this profile.
    */
    public function setAdditionalBillingCycles($additionalBillingCycles)
    {
        $this->additionalBillingCycles = $additionalBillingCycles;

        return $this;
    }

    public function setOutstandingAmt($outstandingAmt)
    {
        $this->outstandingAmt = $outstandingAmt;

        return $this;
    }

    /**
     * (Optional) Indicates whether you would like PayPal to automatically bill
     * the outstanding balance amount in the next billing cycle. The outstanding
     * balance is the total amount of any previously failed scheduled payments
     * that have yet to be successfully paid. 
     * It is one of the following values:
     * NoAutoBill – PayPal does not automatically bill the outstanding balance.
     * AddToNextBilling – PayPal automatically bills the outstanding balance.
     *
     * @param $autoBillOutAmt
     * @return Payment
     */
    public function setAutoBillOutAmt($autoBillOutAmt)
    {
        $this->autoBillOutAmt = $autoBillOutAmt;

        return $this;
    }

    /**
     * (Optional) Number of scheduled payments that can fail before the profile
     * is automatically suspended. An IPN message is sent to the merchant when
     * the specified number of failed payments is reached.
     * Character length and limitations: Number string representing an integer.
     *
     * @param $maxFailedPayments
     * @return Payment
     */
    public function setMaxFailedPayments($maxFailedPayments)
    {
        $this->maxFailedPayments = $maxFailedPayments;

        return $this;
    }

    /**
     * (Required) The date when billing for this profile begins.
     * Character length and limitations: Must be a valid date, in UTC/GMT format
     * Note: The profile may take up to 24 hours for activation.
     *
     * @param $profileStartDate
     * @return Payment
     */
    public function setProfileStartDate($profileStartDate)
    {
        $this->profileStartDate = $profileStartDate;

        return $this;
    }

    /**
     * (Optional) Number of billing cycles for payment period.
     * For the regular payment period, if no value is specified or the value is 0,
     * the regular payment period continuesuntil the profile is canceled or deactivated.
     * For the regular payment period, if the value is greater than 0, the regular
     * payment period will expire after the trial period is finished and continue
     * at the billing frequency for TotalBillingCycles cycles.
     *
     * @param $totalBillingCycles
     * @return Payment
     */
    public function setTotalBillingCycles($totalBillingCycles)
    {
        $this->totalBillingCycles = $totalBillingCycles;

        return $this;
    }

    /**
     * (Required) Billing amount for each billing cycle during this payment period. 
     * This amount does not include shipping and tax amounts.
     * Value is a positive number which cannot exceed $10,000 USD in any currency.
     * It includes no currency symbol. It must have 2 decimal places, the decimal
     * separator must be a period (.), and the optional thousands separator must be a comma (,).
     *
     * @param $amt
     * @return Payment
     */
    public function setAmt($amt)
    {
        $this->amt = $amt;

        return $this;
    }

    /**
     * (Optional) Number of billing cycles for trial payment period.
     *
     * @param $trialTotalBillingCycles
     * @return Payment
     */
    public function setTrialTotalBillingCycles($trialTotalBillingCycles)
    {
        $this->trialTotalBillingCycles = $trialTotalBillingCycles;

        return $this;
    }

    /**
     * Billing amount for each billing cycle during this payment period; required
     * if you specify an optional trial period. This amount does not include shipping
     * and tax amounts.
     * Value is a positive number which cannot exceed $10,000 USD in any currency.
     * It includes no currency symbol. It must have 2 decimal places, the decimal
     * separator must be a period (.), and the optional thousands separator must be a comma (,).
     *
     * @param $trialAmt
     * @return Payment
     */
    public function setTrialAmt($trialAmt)
    {
        $this->trialAmt = $trialAmt;

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
     * (Optional) Shipping amount for each billing cycle during this payment period.
     * Character length and limitations: Value is a positive number which cannot
     * exceed $10,000 USD in any currency. It includes no currency symbol.
     * It must have 2 decimal places, the decimal separator must be a period (.), and
     * the optional thousands separator must be a comma (,).
     *
     * @param $shippingAmt
     * @return Payment
     */
    public function setShippingAmt($shippingAmt)
    {
        $this->shippingAmt = $shippingAmt;

        return $this;
    }

    /**
     * (Optional) Tax amount for each billing cycle during this payment period.
     * Character length and limitations: Value is a positive number which cannot
     * exceed $10,000 USD in any currency. It includes no currency symbol. It must
     * have 2 decimal places, the decimal separator must be a period (.), and
     * the optional thousands separator must be a comma (,).
     *
     * @param $taxAmt
     */
    public function setTaxAmt($taxAmt)
    {
        $this->taxAmt = $taxAmt;

        return $this;
    }

    /**
     * (Optional) Type of credit card. For UK, only Maestro, MasterCard, Discover,
     * and Visa are allowable. For Canada, only MasterCard and Visa are allowable
     * and Interac debit cards are not supported. It is one of the following values:
     *
     *   Visa
     *   MasterCard
     *   Discover
     *   Amex
     *   Maestro: See note.
     *
     * NOTE:If the credit card type is Maestro, you must set CURRENCYCODE to GBP.
     * In addition, you must specify either STARTDATE or ISSUENUMBER.
     *
     * Character length and limitations: Up to 10 single-byte alphabetic characters
     *
     * @param $creditCardType
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
     * Proxy to setAcct
     */
    public function setCardNumber($v)
    {
        $this->setAcct($v);

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
     */
    public function setExpirationDate($date)
    {
        $this->setExpDate($date);

        return $this;
    }

    /**
     * Card Verification Value, version 2. Your Merchant Account settings determine whether
     * this field is required. To comply with credit card processing regulations, you must
     * not store this value after a transaction has been completed.
     *
     * Character length and limitations: For Visa, MasterCard, and Discover, the
     * value is exactly 3 digits. For American Express, the value is exactly 4 digits.
     *
     * @param $cvv2
     */
    public function setCvv2($cvv2)
    {
        $this->cvv2 = $cvv2;

        return $this;
    }

    /**
     * (Optional) Month and year that Maestro card was issued.
     * Character length and limitations: Must be 6 digits, including leading zero,
     * in the format MMYYYY
     *
     * @param $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * (Optional) Issue number of Maestro card.
     *
     * Character length and limitations: 2 numeric digits maximum
     *
     * @param $ipAddress
     */
    public function setIssueNumber($issueNumber)
    {
        $this->issueNumber = $issueNumber;

        return $this;
    }

    /**
     * (Optional) Email address of buyer.
     * Character length and limitations: 127 single-byte characters
     *
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * (Optional) Buyer's first name.
     * Character length and limitations: 25 single-byte characters
     *
     * @param $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * (Optional) Buyer's last name.
     * Character length and limitations: 25 single-byte characters
     *
     * @param $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAddress()
    {
        return $this->_address;
    }

    public function getShipAddress()
    {
        return $this->_shipAddress;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getProfileId()
    {
        return $this->profileId;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function getSubscriberName()
    {
        return $this->subscriberName;
    }

    public function getProfileReference()
    {
        return $this->profileReference;
    }

    public function getAdditionalBillingCycles()
    {
        return $this->additionalBillingCycles;
    }

    public function getOutstandingAmt()
    {
        return $this->outstandingAmt;
    }

    public function getAutoBillOutAmt()
    {
        return $this->autoBillOutAmt;
    }

    public function getMaxFailedPayments()
    {
        return $this->maxFailedPayments;
    }

    public function getProfileStartDate()
    {
        return $this->profileStartDate;
    }

    public function getTotalBillingCycles()
    {
        return $this->totalBillingCycles;
    }

    public function getAmt()
    {
        return $this->amt;
    }

    public function getTrialTotalBillingCycles()
    {
        return $this->trialTotalBillingCycles;
    }

    public function getTrialAmt()
    {
        return $this->trialAmt;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function getShippingAmt()
    {
        return $this->shippingAmt;
    }

    public function getTaxAmt()
    {
        return $this->taxAmt;
    }

    public function getCreditCardType()
    {
        return $this->creditCardType;
    }

    public function getAcct()
    {
        return $this->acct;
    }

    public function getCardNumber()
    {
        return $this->getAcct();
    }

    public function getExpDate()
    {
        return $this->expDate;
    }

    public function getExpirationDate()
    {
        return $this->getExpDate();
    }

    public function getCvv2()
    {
        return $this->cvv2;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getIssueNumber()
    {
        return $this->issueNumber;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Validate the minimum set of required values for UpdateRecurringPaymentsProfile
     *
     * @return bool
     */
    public function isValid()
    {
        //validate recurringPayment values
        $checkEmpty = array(
            $this->profileId,
        );

        if(!$this->checkEmpty($checkEmpty)) {
            return false;
        }

        return true;
    }

    public function toArray()
    {
        $data = parent::toArray();

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