<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;
use SpeckPaypal\Element\ExpressShippingOption;

class Callback extends AbstractRequest
{
    protected $token;
    protected $currencyCode = 'USD';
    protected $offerInsuranceOption;
    protected $_shippingOptions;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('CallbackResponse');
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
    }

    /**
     * (Optional) - If callback url is not set
     * (Required) - If callback url is set
     */
    public function setShippingOptions($options)
    {
        if(!is_array($options)) {
            $options = array($options);
        }
        $this->_shippingOptions = $options;

        return $this;
    }

    /**
     *	(Optional)
     *  Indicates whether or not PayPal should display insurance in a drop-down
     *	list on the Review page. When the value is true, PayPal displays the drop-down
     *	with the associated amount and the string ëYes.í
     *
     * @param string $bool
     * @return Callback
     */
    public function setOfferInsuranceOption($bool = "false")
    {
        $this->offerInsuranceOption = (string) $bool;

        return $this;
    }

    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    public function getShippingOptions()
    {
        return $this->_shippingOptions;
    }

    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getOfferInsuranceOption()
    {
        return $this->offerInsuranceOption;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function isValid()
    {
        if(empty($this->currencyCode) || is_null($this->_shippingOptions)) {
            return false;
        }

        //test that shipping options are valid
        $valid  = true;
        $option = $this->_shippingOptions;

        for($i =0 ; $i < count($option); $i++) {
            if(!$option[$i] instanceof ExpressShippingOption) {
                $valid = false;
                break;
            }

            $test = array(
                $option[$i]->getName(),
                $option[$i]->getLabel(),
                $option[$i]->getAmount(),
                $option[$i]->getDefault()
            );

            if(!$this->checkEmpty($test)) {
                $valid = false;
                break;
            }
        }

        return $valid;
    }

    public function toArray()
    {
        $data = parent::toArray();
        if(!is_null($this->_shippingOptions)) {
            $option = $this->_shippingOptions;
            for($i =0 ; $i < count($option); $i++) {
                if(!$option[$i] instanceof ExpressShippingOption) {
                    continue;
                }

                $data["L_SHIPPINGOPTIONNAME{$i}"] 		= $option[$i]->getName();
                $data["L_SHIPPINGOPTIONLABEL{$i}"] 		= $option[$i]->getLabel();
                $data["L_SHIPPINGOPTIONAMOUNT{$i}"] 	= $option[$i]->getAmount();
                $data["L_TAXAMT{$i}"] 					= $option[$i]->getTaxAmount();
                $data["L_INSURANCEAMOUNT{$i}"] 			= $option[$i]->getInsuranceAmount();
                $data["L_SHIPPINGOPTIONISDEFAULT{$i}"] 	= $option[$i]->getDefault();
            }
        }

        return $data;
    }
}