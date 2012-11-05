<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;

class DoExpressCheckoutPayment extends AbstractRequest
{
    /*
     * General request fields
     */
    protected $token;
    protected $payerId;
    protected $returnFmfDetails;
    protected $giftMessage;
    protected $giftReceiptEnable;
    protected $giftWrapName;
    protected $giftWrapAmount;
    protected $buyerMarketingEmail;
    protected $surveyQuestion;
    protected $surveyChoiceSelected;
    protected $buttonSource;

    /*
     * User selected options
     */
    protected $insuranceOptionSelected;
    protected $shippingOptionIsDefault;
    protected $shippingOptionAmount;
    protected $shippingOptionName;

    protected $_paymentDetails;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('DoExpressCheckoutPayment');
    }

    public function setPaymentDetails($paymentDetails)
    {
        if(!is_array($paymentDetails)) {
            $paymentDetails = array($paymentDetails);
        }
        $this->_paymentDetails = $paymentDetails;

        return $this;
    }

    /**
     * (Optional)
     * A timestamped token, the value of which was returned by
     * SetExpressCheckout response.
     * Character length and limitations: 20 single-byte characters
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     *	(Required)
     * 	Unique PayPal customer account identification number as returned by
     *	GetExpressCheckoutDetails response.Character length and limitations: 13
     *	single-byte alphanumeric characters
     */
    public function setPayerId($id)
    {
        $this->payerId = $id;
        return $this;
    }

    /**
     *	(Optional)
     *  Flag to indicate whether you want the results returned by Fraud
     *	Management Filters. By default, you do not receive this information.
     *	0 - do not receive FMF details (default)
     *	1 - receive FMF details
     */

    public function setReturnFmfDetails($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->returnFmfDetails = $val;

        return $this;
    }

    /**
     *	(Optional) An identification code for use by third-party applications to identify
     *	transactions.
     *	Character length and limitations: 32 single-byte alphanumeric characters
     */
    public function setButtonSource($source)
    {
        $this->buttonSource = $source;

        return $this;
    }

    /**
     * (Optional) The buyer email address opted in by the buyer on the PayPal pages.
     * Character length and limitations: 127 single-byte characters
     *
     * @param $buyerMarketingEmail
     * @return DoExpressCheckoutPayment
     */
    public function setBuyerMarketingEmail($buyerMarketingEmail)
    {
        $this->buyerMarketingEmail = $buyerMarketingEmail;

        return $this;
    }

    /**
     * (Optional) The gift message the buyer entered on the PayPal pages.
     * Character length and limitations: 150 single-byte characters
     *
     * @param $giftMessage
     * @return DoExpressCheckoutPayment
     */
    public function setGiftMessage($giftMessage)
    {
        $this->giftMessage = $giftMessage;

        return $this;
    }

    /**
     * (Optional) Whether the buyer selected a gift receipt on the PayPal pages. It is one of the following values:
     *
     * true – The buyer selected a gift message.
     * false – The buyer did not select a gift message.
     *
     * @param $giftReceiptEnable
     * @return DoExpressCheckoutPayment
     */
    public function setGiftReceiptEnable($giftReceiptEnable)
    {
        $this->giftReceiptEnable = $giftReceiptEnable;

        return $this;
    }

    /**
     * (Optional) Amount only if the buyer selected the gift option on the PayPal pages.
     * Character length and limitations: Value is a positive number which cannot exceed $10,000 USD
     * in any currency. It includes no currency symbol. It must have 2 decimal places, the decimal
     * separator must be a period (.), and the optional thousands separator must be a comma (,).
     *
     * @param $giftWrapAmount
     * @return DoExpressCheckoutPayment
     */
    public function setGiftWrapAmount($giftWrapAmount)
    {
        $this->giftWrapAmount = $giftWrapAmount;

        return $this;
    }

    /**
     * (Optional) Return the gift wrap name only if the buyer selected the gift option on the PayPal pages.
     * Character length and limitations: 25 single-byte characters
     *
     * @param $giftWrapName
     * @return DoExpressCheckoutPayment
     */
    public function setGiftWrapName($giftWrapName)
    {
        $this->giftWrapName = $giftWrapName;

        return $this;
    }

    /**
     * (Optional) The option that the buyer chose for insurance. It is one of the following values:
     *
     * Yes – The buyer opted for insurance.
     * No – The buyer did not opt for insurance.
     *
     * @param $insuranceOptionSelected
     * @return DoExpressCheckoutPayment
     */
    public function setInsuranceOptionSelected($insuranceOptionSelected)
    {
        $this->insuranceOptionSelected = $insuranceOptionSelected;

        return $this;
    }

    /**
     * (Optional) The shipping amount that the buyer chose.
     *
     * Character length and limitations: Value is a positive number which cannot exceed $10,000 USD
     * in any currency. It includes no currency symbol. It must have 2 decimal places, the decimal
     * separator must be a period (.), and the optional thousands separator must be a comma (,).
     *
     * @param $shippingOptionAmount
     * @return DoExpressCheckoutPayment
     */
    public function setShippingOptionAmount($shippingOptionAmount)
    {
        $this->shippingOptionAmount = $shippingOptionAmount;

        return $this;
    }

    /**
     * (Optional) Whether the buyer chose the default shipping option. It is one of the following values:
     *
     * true – The buyer chose the default shipping option.
     * false – The buyer did not choose the default shipping option.
     *
     * @param $shippingOptionIsDefault
     * @return DoExpressCheckoutPayment
     */
    public function setShippingOptionIsDefault($shippingOptionIsDefault)
    {
        $this->shippingOptionIsDefault = $shippingOptionIsDefault;

        return $this;
    }

    /**
     * (Optional) The name of the shipping option, such as air or ground.
     *
     * @param $shippingOptionName
     * @return DoExpressCheckoutPayment
     */
    public function setShippingOptionName($shippingOptionName)
    {
        $this->shippingOptionName = $shippingOptionName;

        return $this;
    }

    /**
     * (Optional) Survey response that the buyer selected on the PayPal pages.
     * Character length and limitations: 15 single-byte characters
     *
     * @param $surveyChoiceSelected
     * @return DoExpressCheckoutPayment
     */
    public function setSurveyChoiceSelected($surveyChoiceSelected)
    {
        $this->surveyChoiceSelected = $surveyChoiceSelected;

        return $this;
    }

    /**
     * (Optional) Survey question on the PayPal pages.
     * Limitations: 50 single-byte characters
     *
     * @param $surveyQuestion
     * @return DoExpressCheckoutPayment
     */
    public function setSurveyQuestion($surveyQuestion)
    {
        $this->surveyQuestion = $surveyQuestion;

        return $this;
    }

    public function getButtonSource()
    {
        return $this->buttonSource;
    }

    public function getBuyerMarketingEmail()
    {
        return $this->buyerMarketingEmail;
    }

    public function getGiftMessage()
    {
        return $this->giftMessage;
    }

    public function getGiftReceiptEnable()
    {
        return $this->giftReceiptEnable;
    }

    public function getGiftWrapAmount()
    {
        return $this->giftWrapAmount;
    }

    public function getGiftWrapName()
    {
        return $this->giftWrapName;
    }

    public function getInsuranceOptionSelected()
    {
        return $this->insuranceOptionSelected;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPayerId()
    {
        return $this->payerId;
    }

    public function getReturnFmfDetails()
    {
        return $this->returnFmfDetails;
    }

    public function getShippingOptionAmount()
    {
        return $this->shippingOptionAmount;
    }

    public function getShippingOptionIsDefault()
    {
        return $this->shippingOptionIsDefault;
    }

    public function getShippingOptionName()
    {
        return $this->shippingOptionName;
    }

    public function getSurveyChoiceSelected()
    {
        return $this->surveyChoiceSelected;
    }

    public function getSurveyQuestion()
    {
        return $this->surveyQuestion;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getPaymentDetails()
    {
        return $this->_paymentDetails;
    }

    /**
     * Test the minimum required values for doExpressCheckoutPayment
     *
     * @return bool
     */
    public function isValid()
    {
        if(empty($this->token) || empty($this->payerId) || is_null($this->_paymentDetails)) {
            return false;
        }

        $valid = true;
        foreach($this->_paymentDetails as $detail) {
            if(empty($detail)) {
                $valid = false;
                break;
            }

            $amt = $detail->getAmt();

            if(empty($amt)) {
                $valid = false;
                break;
            }
        }

        return $valid;
    }

    public function toArray()
    {
        $data = parent::toArray();

        //parse payment details
        if(is_null($this->_paymentDetails)) {
            throw new \Exception("Missing payment details.");
        }

        $idx = 0;
        foreach($this->_paymentDetails as $paymentDetail) {
            $paymentDetail->setPrefix("PAYMENTREQUEST_{$idx}_");
            $data = array_merge($data, $paymentDetail->toArray());
            $idx++;
        }

        return $data;
    }
}