<?php
namespace SpeckPaypal\Element;

use SpeckPaypal\ValueObject\CountryCodes;
use SpeckPaypal\Element\AbstractElement;

class Address extends AbstractElement
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $street;

    /**
     * @var string
     */
    protected $street2;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $zip;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @var string
     */
    protected $phoneNum;

    /**
     * NOTE: used by response only
     *
     * @var string
     */
    protected $addressStatus;


    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setPhoneNum($phoneNum)
    {
        $this->phoneNum = $phoneNum;

        return $this;
    }

    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    public function setStreet2($street2)
    {
        $this->street2 = $street2;

        return $this;
    }

    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    public function setAddressStatus($status)
    {
        $this->addressStatus = $status;

        return $this;
    }

    /**
     * (Required) Country code.
     * Character length and limitations: 2 single-byte characters
     *
     * @param $country
     * @throws Exception
     */
    public function setCountry($country)
    {
        if(strlen($country) > 2) {
            $country = CountryCodes::getCodeByName($country);
        }

        if(!CountryCodes::isValid($country)) {
            /*
             * @todo create Exception class for InvalidCountry
             */
            throw new \Exception('Invalid country specified in '. get_class($this));
        }
        $this->setCountryCode($country);

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function getCountry()
    {
        return $this->getCountryCode();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPhoneNum()
    {
        return $this->phoneNum;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getStreet2()
    {
        return $this->street2;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function getAddressStatus()
    {
        return $this->addressStatus;
    }
}
