<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Element\Address;
use SpeckPaypal\Request\AbstractRequest;

class SetExpressCheckout extends AbstractRequest
{
    const METHOD = "SetExpressCheckout";

    const SOLUTION_SOLE = "Sole";
    const SOLUTION_MARK = "Mark";

    const LANDINGPAGE_BILLING = "Billing";
    const LANDINGPAGE_LOGIN   = "Login";

    const CHANNELTYPE_MERCHANT = "Marchant";
    const CHANNELTYPE_EBAYITEM = "eBayItem";

    const TAXIDTYPE_INDIVIDUAL = "BR_CPF";
    const TAXIDTYPE_BUSINESS   = "BR_CNPJ";

    protected $method;
    protected $maxAmt;
    protected $returnUrl;
    protected $cancelUrl;
    protected $callback;
    protected $callbackTimeout;
    protected $reqConfirmShipping;
    protected $noShipping;
    protected $allowNote;
    protected $addrOverride;
    protected $callbackVersion;
    protected $localeCode;
    protected $pageStyle;
    protected $hdrImg;
    protected $hdrBorderColor;
    protected $payflowColor;
    protected $email;
    protected $solutionType;
    protected $landingPage;
    protected $channelType;
    protected $giroPaySuccessUrl;
    protected $giroPayCancelUrl;
    protected $bankTxPendingUrl;
    protected $brandName;
    protected $customerServiceNumber;
    protected $giftMessageEnable;
    protected $giftReceiptEnable;
    protected $giftWrapEnable;
    protected $giftWrapName;
    protected $giftWrapAmount;
    protected $buyerEmailOptInEnable;
    protected $surveyQuestion;
    protected $surveyEnable;
    protected $buyerId;
    protected $buyerUsername;
    protected $buyerRegistrationDate;
    protected $allowPushFunding;
    protected $taxIdType;
    protected $taxId;


    protected $_paymentDetails;
    protected $_shippingOptions;
    protected $_billingAgreement;
    protected $_surveyChoices;

    public function __construct($options = array())
    {
        parent::__construct($options);
        $this->setMethod(self::METHOD);
    }

    public function setPaymentDetails($paymentDetails)
    {
        if(!is_array($paymentDetails)) {
            $paymentDetails = array($paymentDetails);
        }
        $this->_paymentDetails = $paymentDetails;

        return $this;
    }

    public function getPaymentDetails()
    {
        return $this->_paymentDetails;
    }

    public function setShippingOptions($options)
    {
        if(!is_array($options)) {
            $options = array($options);
        }

        $this->_shippingOptions = $options;

        return $this;
    }

    public function setBillingAgreements($agreements)
    {
        if(!is_array($agreements)) {
            $agreements = array($agreements);
        }

        $this->_billingAgreement = $agreements;

        return $this;
    }

    /**
     * (Optional) Determines whether or not the PayPal pages should display the shipping
     * address set by you in this SetExpressCheckout request, not the shipping address on
     * file with PayPal for this buyer. Displaying the PayPal street address on file does
     * not allow the buyer to edit that address. It is one of the following values:
     *
     * 0 – The PayPal pages should not display the shipping address.
     * 1 – The PayPal pages should display the shipping address.
     *
     * Character length and limitations: 1 single-byte numeric character
     *
     * @param $addrOverride
     * @return SetExpressCheckout
     */
    public function setAddrOverride($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->addrOverride = $val;

        return $this;
    }

    /**
     * (Optional)
     * The value 1 indicates that the customer may enter a note to the merchant
     * on the PayPal page during checkout. The note is returned in the
     * GetExpressCheckoutDetails response and the DoExpressCheckoutPayment
     * response.
     * Character length and limitations: One single-byte numeric character.
     * Allowable values: 0, 1
     *
     * @param $bool
     * @return SetExpressCheckout
     */
    public function setAllowNote($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->allowNote = $val;

        return $this;
    }

    /**
     * (Optional) Indicates whether the merchant can accept push funding. It is one of the following values:
     *
     * 0 – Merchant can accept push funding.
     * 1 – Merchant cannot accept push funding.
     *
     * NOTE:This field overrides the setting in the merchant's PayPal account.
     *
     * @param $bool
     * @return SetExpressCheckout
     */
    public function setAllowPushFunding($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->allowPushFunding = $val;

        return $this;
    }

    /**
     * (Optional) The URL on the merchant site to transfer to after a bank transfer payment.
     *
     * NOTE:Use this field only if you are using giropay or bank transfer payment methods in Germany.
     *
     * @param $bankTxPendingUrl
     * @return SetExpressCheckout
     */
    public function setBankTxPendingUrl($bankTxPendingUrl)
    {
        $this->bankTxPendingUrl = $bankTxPendingUrl;

        return $this;
    }

    /**
     * (Optional) A label that overrides the business name in the PayPal account on the PayPal
     * hosted checkout pages.
     *
     * Character length and limitations: 127 single-byte alphanumeric characters
     *
     * @param $brandName
     * @return SetExpressCheckout
     */
    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;

        return $this;
    }

    /**
     * (Optional) Enables the buyer to provide their email address on the PayPal pages to
     * be notified of promotions or special events. Is one of the following values:
     *
     * 0 – Do not enable buyer to provide email address.
     * 1 – Enable the buyer to provide email address.
     *
     * @param $bool
     * @return SetExpressCheckout
     */
    public function setBuyerEmailOptInEnable($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->buyerEmailOptInEnable = $val;

        return $this;
    }

    /**
     * (Optional) The unique identifier provided by eBay for this buyer. The value may or
     * may not be the same as the username. In the case of eBay, it is different.
     *
     * Character length and limitations: 255 single-byte characters
     *
     * @param $buyerId
     * @return SetExpressCheckout
     */
    public function setBuyerId($buyerId)
    {
        $this->buyerId = $buyerId;

        return $this;
    }

    /**
     * xs:dateTime
     *
     * (Optional) Date when the user registered with the marketplace.
     *
     * Character length and limitations: Date and time are in UTC/GMT format,
     * for example, 2011-06-24T05:38:48Z
     *
     * @param $buyerRegistrationDate
     * @return SetExpressCheckout
     */
    public function setBuyerRegistrationDate($buyerRegistrationDate)
    {
        $this->buyerRegistrationDate = $buyerRegistrationDate;

        return $this;
    }

    /**
     * xs:string
     * (Optional) The user name of the user at the marketplaces site.
     *
     * @param $buyerUsername
     * @return SetExpressCheckout
     */
    public function setBuyerUsername($buyerUsername)
    {
        $this->buyerUsername = $buyerUsername;

        return $this;
    }

    /**
     * (Optional) URL to which the callback request from PayPal is sent. It must start with
     * HTTPS for production integration. It can start with HTTPS or HTTP for sandbox testing.
     *
     * Character length and limitations: 1024 single-byte characters
     *
     * @param $callback
     * @return SetExpressCheckout
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * (Optional)
     * An override for you to request more or less time to be able to process the
     * callback request and respond. The acceptable range for the override is 1 to 6 seconds.
     * If you specify a value greater than 6, PayPal uses the default value of 3 seconds.
     * Character length and limitations: An integer between 1 and 6
     */
    public function setCallbackTimeout($callbackTimeout)
    {
        $this->callbackTimeout = $callbackTimeout;

        return $this;
    }

    /**
     * Version of the callback API. This field is required when implementing the
     * Instant Update Callback API.
     *
     * @param $callbackVersion
     * @return SetExpressCheckout
     */
    public function setCallbackVersion($callbackVersion)
    {
        $this->callbackVersion = $callbackVersion;

        return $this;
    }

    /**
     * (Required)
     * URL to which the customer is returned if he does not approve the use of
     * PayPal to pay you.
     * NOTE: PayPal recommends that the value be the original page on which the
     * customer chose to pay with PayPal or establish a billing agreement.
     * Character length and limitations: 2048 characters
     */
    public function setCancelUrl($cancelUrl)
    {
        $this->cancelUrl = $cancelUrl;

        return $this;
    }

    /**
     * (Optional)
     * Type of channel:
     * Merchant: non-auction seller
     * eBayItem: eBay auction
     */
    public function setChannelType($channelType)
    {
        if(!in_array($channelType, array(self::CHANNELTYPE_EBAYITEM, self::CHANNELTYPE_MERCHANT))) {
            throw new \Exception('Invalid channel type passed.');
        }
        $this->channelType = $channelType;

        return $this;
    }

    /**
     * (Optional) Merchant Customer Service number displayed on the PayPal pages.
     *
     * Character length and limitations: 16 single-byte characters
     *
     * @param $customerServiceNumber
     * @return SetExpressCheckout
     */
    public function setCustomerServiceNumber($customerServiceNumber)
    {
        $this->customerServiceNumber = $customerServiceNumber;

        return $this;
    }

    /**
     * (Optional)
     * Email address of the buyer as entered during checkout. PayPal uses this
     * value to pre-fill the PayPal membership sign-up portion of the PayPal login page.
     * Character length and limit: 127 single-byte alphanumeric characters
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * (Optional) Enables the gift message widget on the PayPal pages. It is one of the following values:
     *
     * 0 – Do not enable gift message widget.
     * 1 – Enable gift message widget.
     *
     * @param $bool
     * @return SetExpressCheckout
     */
    public function setGiftMessageEnable($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->giftMessageEnable = $val;

        return $this;
    }

    /**
     * (Optional) Enable gift receipt widget on the PayPal pages. It is one of the following values:
     *
     * 0 – Do not enable gift receipt widget.
     * 1 – Enable gift receipt widget.
     *
     * @param $bool
     * @return SetExpressCheckout
     */
    public function setGiftReceiptEnable($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->giftReceiptEnable = $val;

        return $this;
    }

    /**
     * (Optional) Amount to be charged to the buyer for gift wrapping..
     *
     * Character length and limitations: Value is a positive number which cannot exceed
     * $10,000 USD in any currency. It includes no currency symbol. It must have 2 decimal
     * places, the decimal separator must be a period (.), and the optional thousands
     * separator must be a comma (,).
     *
     * @param $giftWrapAmount
     * @return SetExpressCheckout
     */
    public function setGiftWrapAmount($giftWrapAmount)
    {
        $this->giftWrapAmount = $giftWrapAmount;

        return $this;
    }

    /**
     * Optional) Enable gift wrap widget on the PayPal pages. It is one of the following values
     *
     * 0 – Do not enable gift wrap widget.
     * 1 – Enable gift wrap widget.
     *
     * NOTE:If you pass the value 1 in this field, values for the gift wrap amount and gift wrap
     * name are not passed, the gift wrap name is not displayed, and the gift wrap amount
     * displays as 0.00.
     *
     * @param $bool
     * @return SetExpressCheckout
     */
    public function setGiftWrapEnable($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->giftWrapEnable = $val;

        return $this;
    }

    /**
     * (Optional) Label for the gift wrap option such as “Box with ribbon”.
     *
     * Character length and limitations: 25 single-byte characters
     *
     * @param $giftWrapName
     * @return SetExpressCheckout
     */
    public function setGiftWrapName($giftWrapName)
    {
        $this->giftWrapName = $giftWrapName;

        return $this;
    }

    /**
     * (Optional) The URL on the merchant site to redirect to after a successful giropay payment.
     *
     * NOTE:Use this field only if you are using giropay or bank transfer payment methods in Germany.
     *
     * @param $giroPayCancelUrl
     * @return SetExpressCheckout
     */
    public function setGiroPayCancelUrl($giroPayCancelUrl)
    {
        $this->giroPayCancelUrl = $giroPayCancelUrl;

        return $this;
    }

    /**
     * (Optional) The URL on the merchant site to redirect to after a successful giropay payment.
     *
     * NOTE:Use this field only if you are using giropay or bank transfer payment methods in Germany.
     *
     * @param $giroPaySuccessUrl
     * @return SetExpressCheckout
     */
    public function setGiroPaySuccessUrl($giroPaySuccessUrl)
    {
        $this->giroPaySuccessUrl = $giroPaySuccessUrl;

        return $this;
    }

    /**
     * (Optional) Sets the border color around the header of the payment page. The border is
     *	a 2-pixel perimeter around the header space, which is 750 pixels wide by 90 pixels
     *	high. By default, the color is black.
     *	Character length and limitation: Six character HTML hexadecimal color code in
     *	ASCII.
     */
    public function setHdrBorderColor($hdrBorderColor)
    {
        $this->hdrBorderColor = $hdrBorderColor;

        return $this;
    }

    /**
     * (Optional) URL for the image you want to appear at the top left of the payment page.
     *	The image has a maximum size of 750 pixels wide by 90 pixels high. PayPal
     *	recommends that you provide an image that is stored on a secure (https) server. If you
     *	do not specify an image, the business name is displayed.
     *	Character length and limit: 127 single-byte alphanumeric characters
     */
    public function setHdrImg($hdrImg)
    {
        $this->hdrImg = $hdrImg;

        return $this;
    }

    /**
     * (Optional)
     * Type of PayPal page to display:
     * Billing: non-PayPal account
     * Login: PayPal account login
     */
    public function setLandingPage($landingPage)
    {
        if(!in_array($landingPage, array(self::LANDINGPAGE_BILLING, self::LANDINGPAGE_LOGIN))) {
            throw new \Exception('Invalid landing page value passed.');
        }
        $this->landingPage = $landingPage;

        return $this;
    }

    /**
     * (Optional)
     * Locale of pages displayed by PayPal during Express Checkout.
     * Character length and limitations: Any two-character country code.
     */
    public function setLocaleCode($localeCode)
    {
        $this->localeCode = $localeCode;

        return $this;
    }

    /**
     * (Optional) The expected maximum total amount of the complete order, including shipping cost
     * and tax charges. If the transaction includes one or more one-time purchases, this field
     * is ignored.
     *
     * For recurring payments, you should pass the expected average transaction amount (default 25.00).
     * PayPal uses this value to validate the buyer’s funding source.
     *
     * Character length and limitations: Value is a positive number which cannot exceed $10,000 USD in
     * any currency. It includes no currency symbol. It must have 2 decimal places, the decimal
     * separator must be a period (.), and the optional thousands separator must be a comma (,)
     *
     * NOTE:This field is required when implementing the Instant Update API callback. PayPal
     * recommends that the maximum total amount be slightly greater than the sum of the line-item
     * order details, tax, and the shipping options of greatest value.
     *
     * @param $amount
     * @return SetExpressCheckout
     */
    public function setMaxAmt($maxAmt)
    {
        $this->maxAmt = $maxAmt;

        return $this;
    }

    /**
     * (Optional)
     * The value 1 indicates that on the PayPal pages, no shipping address fields
     * should be displayed whatsoever.
     * Character length and limitations: One single-byte numeric character.
     * Allowable values: 0, 1
     */
    public function setNoShipping($noShipping)
    {
        if(!in_array($noShipping, array(0, 1, 2))) {
            throw new \Exception('Invalid no shipping value passed.');
        }
        $this->noShipping = $noShipping;

        return $this;
    }

    /**
     * (Optional)
     * Sets the Custom Payment Page Style for payment pages associated with
     *	this button/link. This value corresponds to the HTML variable page_style for
     *	customizing payment pages. The value is the same as the Page Style Name you chose
     *	when adding or editing the page style from the Profile subtab of the My Account
     *	tab of your PayPal account.
     *	Character length and limitations: 30 single-byte alphabetic characters.
     */
    public function setPageStyle($pageStyle)
    {
        $this->pageStyle = $pageStyle;

        return $this;
    }

    /**
     * (Optional) Sets the background color for the payment page. By default, the color is
     *	white.
     *	Character length and limitation: Six character HTML hexadecimal color code in
     *	ASCII.
     */
    public function setPayflowColor($payflowColor)
    {
        $this->payflowColor = $payflowColor;

        return $this;
    }

    /**
     * (Optional)
     * The value 1 indicates that you require that the customerís shipping address
     * on file with PayPal be a confirmed address.
     * NOTE: Setting this field overrides the setting you have specified in your Merchant
     * Account Profile.
     * Character length and limitations: One single-byte numeric character.
     * Allowable values: 0, 1
     */
    public function setReqConfirmShipping($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->reqConfirmShipping = $val;

        return $this;
    }


    /**
     * (Required)
     * URL to which the customerís browser is returned after choosing to pay
     * with PayPal.
     * NOTE: PayPal recommends that the value be the final review page on which the
     * customer confirms the order and payment or billing agreement.
     *
     * Character length and limitations: 2048 characters
     */
    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
    }

    /**
     * (Optional)
     * Type of checkout flow:
     * Sole: Express Checkout for auctions
     * Mark: Normal Express Checkout
     */
    public function setSolutionType($solutionType)
    {
        if(!in_array($solutionType, array(self::SOLUTION_MARK, self::SOLUTION_SOLE))) {
            throw new \Exception('Invalid solution type value passed.');
        }
        $this->solutionType = $solutionType;

        return $this;
    }

    /**
     * (Optional) Enables survey functionality. It is one of the following values:
     *
     * 0 – Disables survey functionality.
     * 1 – Enables survey functionality.
     *
     * @param $bool
     * @return SetExpressCheckout
     */
    public function setSurveyEnable($bool)
    {
        $val = ($bool) ? 1 : 0;
        $this->surveyEnable = $val;

        return $this;
    }

    /**
     * (Optional) Text for the survey question on the PayPal pages. If the survey question is present,
     * at least 2 survey answer options must be present.
     *
     * Character length and limitations: 50 single-byte characters
     *
     * @param $surveyQuestion
     * @return SetExpressCheckout
     */
    public function setSurveyQuestion($surveyQuestion)
    {
        $this->surveyQuestion = $surveyQuestion;

        return $this;
    }

    /**
     * Buyer’s tax ID. This field is required for Brazil and used for Brazil only.
     *
     * For Brazil use only: The tax ID is 11 single-byte characters for individuals and 14
     * single-byte characters for businesses.
     *
     * @param $taxId
     * @return SetExpressCheckout
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;

        return $this;
    }

    /**
     * Buyer’s tax ID type. This field is required for Brazil and used for Brazil only.
     * For Brazil use only: The tax ID type is BR_CPF for individuals and BR_CNPJ for businesses.
     *
     * @param $taxIdType
     * @return SetExpressCheckout
     */
    public function setTaxIdType($taxIdType)
    {
        if(!in_array($taxIdType, array(self::TAXIDTYPE_BUSINESS, self::TAXIDTYPE_INDIVIDUAL))) {
            throw new \Exception('Invalid tax id type passed.');
        }

        $this->taxIdType = $taxIdType;

        return $this;
    }

    public function getAddrOverride()
    {
        return $this->addrOverride;
    }

    public function getAllowNote()
    {
        return $this->allowNote;
    }

    public function getAllowPushFunding()
    {
        return $this->allowPushFunding;
    }

    public function getBankTxPendingUrl()
    {
        return $this->bankTxPendingUrl;
    }

    public function getBrandName()
    {
        return $this->brandName;
    }

    public function getBuyerEmailOptInEnable()
    {
        return $this->buyerEmailOptInEnable;
    }

    public function getBuyerId()
    {
        return $this->buyerId;
    }

    public function getBuyerRegistrationDate()
    {
        return $this->buyerRegistrationDate;
    }

    public function getBuyerUsername()
    {
        return $this->buyerUsername;
    }

    public function getCallback()
    {
        return $this->callback;
    }

    public function getCallbackTimeout()
    {
        return $this->callbackTimeout;
    }

    public function getCallbackVersion()
    {
        return $this->callbackVersion;
    }

    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    public function getChannelType()
    {
        return $this->channelType;
    }

    public function getCustomerServiceNumber()
    {
        return $this->customerServiceNumber;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getGiftMessageEnable()
    {
        return $this->giftMessageEnable;
    }

    public function getGiftReceiptEnable()
    {
        return $this->giftReceiptEnable;
    }

    public function getGiftWrapAmount()
    {
        return $this->giftWrapAmount;
    }

    public function getGiftWrapEnable()
    {
        return $this->giftWrapEnable;
    }

    public function getGiftWrapName()
    {
        return $this->giftWrapName;
    }

    public function getGiroPayCancelUrl()
    {
        return $this->giroPayCancelUrl;
    }

    public function getGiroPaySuccessUrl()
    {
        return $this->giroPaySuccessUrl;
    }

    public function getHdrBorderColor()
    {
        return $this->hdrBorderColor;
    }

    public function getHdrImg()
    {
        return $this->hdrImg;
    }

    public function getLandingPage()
    {
        return $this->landingPage;
    }

    public function getLocaleCode()
    {
        return $this->localeCode;
    }

    public function getMaxAmt()
    {
        return $this->maxAmt;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getNoShipping()
    {
        return $this->noShipping;
    }

    public function getPageStyle()
    {
        return $this->pageStyle;
    }

    public function getPayflowColor()
    {
        return $this->payflowColor;
    }

    public function getReqConfirmShipping()
    {
        return $this->reqConfirmShipping;
    }

    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    public function getSolutionType()
    {
        return $this->solutionType;
    }

    public function getSurveyEnable()
    {
        return $this->surveyEnable;
    }

    public function getSurveyQuestion()
    {
        return $this->surveyQuestion;
    }

    public function getTaxId()
    {
        return $this->taxId;
    }

    public function getTaxIdType()
    {
        return $this->taxIdType;
    }

    public function getBillingAgreement()
    {
        return $this->_billingAgreement;
    }

    public function getRequired()
    {
        return $this->_required;
    }

    public function getShippingOptions()
    {
        return $this->_shippingOptions;
    }

    public function getSurveyChoices()
    {
        return $this->_surveyChoices;
    }

    /**
     * Check the minimum required values for setExpressCheckout
     * Required:
     *  AMT
     *  RETURNURL
     *  CANCELURL
     *
     * @return bool
     */
    public function isValid()
    {
        if(empty($this->returnUrl) || empty($this->cancelUrl)) {
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

        $idx = 0;
        if(!is_null($this->_paymentDetails)) {
            foreach($this->_paymentDetails as $paymentDetail) {
                $paymentDetail->setPrefix("PAYMENTREQUEST_{$idx}_");
                $data = array_merge($data, $paymentDetail->toArray());
                $idx++;
            }
        }

        //parse shipping options
        if(!is_null($this->_shippingOptions)) {
            $option = $this->_shippingOptions;
            for($i = 0 ; $i < count($option); $i++) {
                if(!($option[$i] instanceof ExpressShippingOption)) {
                    continue;
                }

                $data["L_SHIPPINGOPTIONNAME{$i}"] 		= $option[$i]->getName();
                $data["L_SHIPPINGOPTIONAMOUNT{$i}"] 	= $option[$i]->getAmount();
                $data["L_SHIPPINGOPTIONISDEFAULT{$i}"] 	= $option[$i]->getDefault();
            }
        }

        return $data;
    }
}