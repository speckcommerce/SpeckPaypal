<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;
use SpeckPaypal\Element\Address;

class CreateRecurringPaymentsProfile extends AbstractRequest
{
    protected $_address;
    protected $_shipAddress;

    protected $token;

    /* Schedule Details */
    protected $desc;
    protected $maxFailedPayments;
    protected $autoBillOutAmt;

    /* Recurring Payments Profile Details */
    protected $subscriberName;
    protected $profileStartDate;
    protected $profileReference;
    
    /* Billing Period Details */
    protected $billingPeriod;
    protected $billingFrequency;
    protected $totalBillingCycles;
    protected $amt;
    protected $trialBillingPeriod;
    protected $trialBillingFrequency;
    protected $trialTotalBillingCycles;
    protected $trialAmt;
    protected $currencyCode = 'USD';
    protected $shippingAmt;
    protected $taxAmt;

    /* Activation Details */
    protected $initAmt;
    protected $failedInitAmtAction;
    
    /* Credit Card Details */
    protected $creditCardType;
    protected $acct;
    protected $expDate;
    protected $cvv2;
    protected $startDate;
    protected $issueNumber;
    
    /* Payer Information */
    protected $email;
    protected $payerId;
    protected $payerStatus;
    protected $countryCode;
    protected $business;

    /* Payer Name */
    protected $salutation;
    protected $firstName;
    protected $middleName;
    protected $lastName;
    protected $suffix;


    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('CreateRecurringPaymentsProfile');
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
     * (Optional)
     * A timestamped token, the value of which was returned by the response.
     * Character length and limitations: 20 single-byte characters
     * Note: Tokens expire after approximately 3 hours.
     *
     * @param $token
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }


    /**
     * (Required) Description of the recurring payment.
     * Character length and limitations: 127 single-byte alphanumeric characters
     * You must ensure that this field matches the corresponding billing
     * agreement description included in the SetExpressCheckout request.
     *
     * @param $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;

        return $this;
    }

    /**
     * (Optional) Number of scheduled payments that can fail before the profile
     * is automatically suspended. An IPN message is sent to the merchant when
     * the specified number of failed payments is reached.
     * Character length and limitations: Number string representing an integer.
     *
     * @param $maxFailedPayments
     */
    public function setMaxFailedPayments($maxFailedPayments)
    {
        $this->maxFailedPayments = $maxFailedPayments;

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
     */
    public function setAutoBillOutAmt($autoBillOutAmt)
    {
        if(!in_array($autoBillOutAmt, array('NoAutoBill', 'AddToNextBilling'))) {
            throw new \Exception('Invalid value passed.');
        }

        $this->autoBillOutAmt = $autoBillOutAmt;

        return $this;
    }

    /**
     * (Optional) Full name of the person receiving the product or service paid
     * for by the recurring payment.
     * If not present, the name in the buyer's PayPal account is used.
     * Character length and limitations: 32 single-byte characters
     *
     * @param $subscriberName
     */
    public function setSubscriberName($subscriberName)
    {
        $this->subscriberName = $subscriberName;

        return $this;
    }

    /**
     * (Required) The date when billing for this profile begins.
     * Character length and limitations: Must be a valid date, in UTC/GMT format
     * Note: The profile may take up to 24 hours for activation.
     *
     * @param $profileStartDate
     */
    public function setProfileStartDate($profileStartDate)
    {
        $this->profileStartDate = $profileStartDate;

        return $this;
    }
    /**
     * (Optional) The merchant's own unique reference or invoice number.
     * Character length and limitations: 127 single-byte alphanumeric characters
     *
     * @param $profileReference
     */
    public function setProfileReference($profileReference)
    {
        $this->profileReference = $profileReference;

        return $this;
    }

    /**
     * (Required) Unit for billing during this subscription period.
     * It is one of the following values: Day, Week, SemiMonth, Month, Year
     * The combination of BillingPeriod and BillingFrequency cannot exceed one year.
     *
     * @param $billingPeriod
     */
    public function setBillingPeriod($billingPeriod)
    {
        if(!in_array($billingPeriod, 
                array('Day', 'Week', 'SemiMonth', 'Month', 'Year'))) {
                    throw new \Exception('Invalid period passed.');
        }

        $this->billingPeriod = $billingPeriod;

        return $this;
    }

    /**
     * (Required) Number of billing periods that make up one billing cycle.
     * The combination of billing frequency and billing period must be less than
     * or equal to one year. For example, if the billing cycle is Month, the
     * maximum value for billing frequency is 12. Similarly, if the billing
     * cycle is Week, the maximum value for billing frequency is 52.
     * Note: If the billing period is SemiMonth, the billing frequency must be 1.
     *
     * @param $billingFrequency
     */
    public function setBillingFrequency($billingFrequency)
    {
        $this->billingFrequency = $billingFrequency;

        return $this;
    }

    /**
     * (Optional) Number of billing cycles for payment period.
     * For the regular payment period, if no value is specified or the value is
     * 0, the regular payment period continues until the profile is canceled or
     * deactivated. For the regular payment period, if the value is greater than
     * 0, the regular payment period will expire after the trial period is
     * finished and continue at the billing frequency for TotalBillingCycles cycles.
     *
     * @param $totalBillingCycles
     */
    public function setTotalBillingCycles($totalBillingCycles)
    {
        $this->totalBillingCycles = $totalBillingCycles;

        return $this;
    }

    /**
     * (Required) Billing amount for each billing cycle during this payment
     * period. This amount does not include shipping and tax amounts.
     * Character length and limitations: Value is a positive number which cannot
     * exceed $10,000 USD in any currency. It includes no currency symbol.
     * It must have 2 decimal places, the decimal separator must be a period (.),
     * and the optional thousands separator must be a comma (,).
     *
     * @param $amt
     */
    public function setAmt($amt)
    {
        $this->amt = $amt;

        return $this;
    }

    /**
     * Unit for billing during this subscription period; required if you specify
     * an optional trial period. It is one of the following values:
     * Day, Week, SemiMonth, Month, Year
     * The combination of BillingPeriod and BillingFrequency cannot exceed one year.
     * Note: For SemiMonth, billing is done on the 1st and 15th of each month.
     *
     * @param $trialBillingPeriod
     */
    public function setTrialBillingPeriod($trialBillingPeriod)
    {
        if(!in_array($trialBillingPeriod, 
                array('Day', 'Week', 'SemiMonth', 'Month', 'Year'))) {
                    throw new \Exception('Invalid period passed.');
        }

        $this->trialBillingPeriod = $trialBillingPeriod;

        return $this;
    }

    /**
     * Number of billing periods that make up one billing cycle; required if you
     * specify an optional trial period. The combination of billing frequency
     * and billing period must be less than or equal to one year.
     * For example, if the billing cycle is Month, the maximum value for billing
     * frequency is 12. Similarly, if the billing cycle is Week, the maximum
     * value for billing frequency is 52.
     * Note: If the billing period is SemiMonth, the billing frequency must be 1.
     *
     * @param $trialBillingFrequency
     */
    public function setTrialBillingFrequency($trialBillingFrequency)
    {
        $this->trialBillingFrequency = $trialBillingFrequency;

        return $this;
    }

    /**
     * (Optional) Number of billing cycles for trial payment period.
     *
     * @param $trialTotalBillingCycles
     */
    public function setTrialTotalBillingCycles($trialTotalBillingCycles)
    {
        $this->trialTotalBillingCycles = $trialTotalBillingCycles;

        return $this;
    }

    /**
     * Billing amount for each billing cycle during this payment period; required
     * if you specify an optional trial period. This amount does not include
     * shipping and tax amounts. 
     * Character length and limitations: Value is a positive number which cannot
     * exceed $10,000 USD in any currency. It includes no currency symbol.
     * It must have 2 decimal places, the decimal separator must be a period (.),
     * and the optional thousands separator must be a comma (,).
     * Note: All amounts in the CreateRecurringPaymentsProfile request must have
     * the same currency.
     *
     * @param $trialAmt
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
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * (Optional) Shipping amount for each billing cycle during this payment
     * period. Character length and limitations: Value is a positive number
     * which cannot exceed $10,000 USD in any currency. It includes no currency
     * symbol. It must have 2 decimal places, the decimal separator must be a
     * period (.), and the optional thousands separator must be a comma (,).
     *
     * @param $shippingAmt
     */
    public function setShippingAmt($shippingAmt)
    {
        $this->shippingAmt = $shippingAmt;

        return $this;
    }

    /**
     * (Optional) Tax amount for each billing cycle during this payment period.
     * Character length and limitations: Value is a positive number which cannot
     * exceed $10,000 USD in any currency. It includes no currency symbol. 
     * It must have 2 decimal places, the decimal separator must be a period (.),
     * and the optional thousands separator must be a comma (,).
     *
     * @param $taxAmt
     */
    public function setTaxAmt($taxAmt)
    {
        $this->taxAmt = $taxAmt;

        return $this;
    }

    /**
     * (Optional) Initial non-recurring payment amount due immediately upon
     * profile creation. Use an initial amount for enrolment or set-up fees.
     * Character length and limitations: Value is a positive number which cannot
     * exceed $10,000 USD in any currency. It includes no currency symbol.
     * It must have 2 decimal places, the decimal separator must be a period (.),
     * and the optional thousands separator must be a comma (,).
     *
     * @param $initAmt
     */
    public function setInitAmt($initAmt)
    {
        $this->initAmt = $initAmt;

        return $this;
    }

    /**
     * (Optional) Action you can specify when a payment fails. It is one of the 
     * following values:
     * ContinueOnFailure – By default, PayPal suspends the pending profile in the
     * event that the initial payment amount fails. You can override this default
     * behavior by setting this field to ContinueOnFailure. Then, if the initial
     * payment amount fails, PayPal adds the failed payment amount to the
     * outstanding balance for this recurring payment profile.
     *
     * CancelOnFailure – If this field is not set or you set it to CancelOnFailure,
     * PayPal creates the recurring payment profile, but places it into a pending
     * status until the initial payment completes. If the initial payment clears,
     * PayPal notifies you by IPN that the pending profile has been activated.
     * If the payment fails, PayPal notifies you by IPN that the pending profile
     * has been canceled.
     *
     * @param $failedInitAmtAction
     */
    public function setFailedInitAmtAction($failedInitAmtAction)
    {
        if(!in_array($failedInitAmtAction, 
                array('ContinueOnFailure', 'CancelOnFailure'))) {
                    throw new \Exception('Invalid period passed.');
        }

        $this->failedInitAmtAction = $failedInitAmtAction;

        return $this;
    }

    /**
     * (Optional) Type of credit card. For UK, only Maestro, MasterCard, Discover,
     * and Visa are allowable. For Canada, only MasterCard and Visa are allowable
     * and Interac debit cards are not supported.
     * It is one of the following values:
     * Visa, MasterCard, Discover, Amex, Maestro: See note.
     * NOTE:If the credit card type is Maestro, you must set CURRENCYCODE to GBP.
     * In addition, you must specify either STARTDATE or ISSUENUMBER.
     * Character length and limitations: Up to 10 single-byte alphabetic characters
     */
    public function setCreditCardType($creditCardType)
    {
        if(!in_array($creditCardType,
                array('Visa', 'Mastercard', 'Amex', 'Maestro', 'Discover'))) {
                    throw new \Exception('Invalid credit card type passed.');
        }
        $this->creditCardType = $creditCardType;

        return $this;
    }

    /**
     * (Required) Credit card number.
     * Character length and limitations: Numeric characters only with no spaces
     * or punctuation. The string must conform with modulo and length required
     * by each credit card type.
     */
    public function setAcct($acct)
    {
        $this->acct = $acct;

        return $this;
    }

    /**
     * Proxy to setAcct
     *
     * @param $v
     */
    public function setCardNumber($v)
    {
        $this->setAcct($v);

        return $this;
    }

    /**
     * Credit card expiration date. This field is required if you are using
     * recurring payments with direct payments.
     * Character length and limitations: 6 single-byte alphanumeric characters,
     * including leading zero, in the format MMYYYY.
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
     * Card Verification Value, version 2. Your Merchant Account settings
     * determine whether this field is required. To comply with credit card
     * processing regulations, you must not store this value after a transaction
     * has been completed. Character length and limitations: For Visa, MasterCard,
     * and Discover, the value is exactly 3 digits. For American Express, the
     * value is exactly 4 digits.
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
     * Character length and limitations: Must be 6 digits, including leading
     * zero, in the format MMYYYY.
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
     * Character length and limitations: 2 numeric digits maximum.
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
     * Character length and limitations: 127 single-byte characters.
     *
     * @param $email
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * (Optional) Unique PayPal Customer Account identification number.
     * Character length and limitations:13 single-byte alphanumeric characters.
     *
     * @param $id
     */
    public function setPayerId($id)
    {
        $this->payerId = $id;
        return $this;
    }

    /**
     * (Optional) Status of buyer. It is one of the following values:
     * verified, unverified
     * Character length and limitations: 10 single-byte alphabetic characters.
     *
     * @param $payerStatus
     */
    public function setPayerStatus($payerStatus)
    {
        $this->payerStatus = $payerStatus;
        return $this;
    }

    /**
     * (Optional) Buyer's country of residence in the form of ISO standard 3166
     * two-character country codes.
     * Character length and limitations: 2 single-byte characters.
     *
     * @param $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
        return $this;
    }

    /**
     * (Optional) Buyer's business name.
     * Character length and limitations: 127 single-byte characters.
     *
     * @param $business
     */
    public function setBusiness($business)
    {
        $this->business = $business;
        return $this;
    }

    /**
     * (Optional) Buyer's salutation.
     * Character length and limitations: 20 single-byte characters.
     *
     * @param $salutation
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;

        return $this;
    }

    /**
     * (Optional) Buyer's first name.
     * Character length and limitations: 25 single-byte characters.
     *
     * @param $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * (Optional) Buyer's middle name.
     * Character length and limitations: 25 single-byte characters.
     *
     * @param $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * (Optional) Buyer's last name.
     * Character length and limitations: 25 single-byte characters.
     *
     * @param $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * (Optional) Buyer's suffix.
     * Character length and limitations: 12 single-byte characters.
     *
     * @param $suffix
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;

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

    public function getToken()
    {
        return $this->token;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function getMaxFailedPayments()
    {
        return $this->maxFailedPayments;
    }

    public function getAutoBillOutAmt()
    {
        return $this->autoBillOutAmt;
    }

    public function getSubscriberName()
    {
        return $this->subscriberName;
    }

    public function getProfileStartDate()
    {
        return $this->profileStartDate;
    }

    public function getProfileReference()
    {
        return $this->profileReference;
    }

    public function getBillingPeriod()
    {
        return $this->billingPeriod;
    }

    public function getBillingFrequency()
    {
        return $this->billingFrequency;
    }

    public function getTotalBillingCycles()
    {
        return $this->totalBillingCycles;
    }

    public function getAmt()
    {
        return $this->amt;
    }

    public function getTrialBillingPeriod()
    {
        return $this->trialBillingPeriod;
    }

    public function getTrialBillingFrequency()
    {
        return $this->trialBillingFrequency;
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

    public function getInitAmt()
    {
        return $this->initAmt;
    }

    public function getFailedInitAmtAction()
    {
        return $this->failedInitAmtAction;
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

    public function getPayerId()
    {
        return $this->payerId;
    }

    public function getPayerStatus()
    {
        return $this->payerStatus;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getBusiness()
    {
        return $this->business;
    }

    public function getSalutation()
    {
        return $this->salutation;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getMiddleName()
    {
        return $this->middleName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * Validate the minimum set of required values.
     *
     * @return bool
     */
    public function isValid()
    {
        //validate recurringPayment values
        $checkEmpty = array(
            $this->profileStartDate,
            $this->desc,
            $this->billingPeriod,
            $this->billingFrequency,
            $this->amt,
            $this->currencyCode,
            $this->acct,
            $this->email,
        );

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

        if(!$this->checkEmpty($test)) {
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