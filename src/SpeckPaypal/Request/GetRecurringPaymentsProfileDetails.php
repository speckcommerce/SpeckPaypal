<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;

class GetRecurringPaymentsProfileDetails extends AbstractRequest
{
    protected $profileId;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('GetRecurringPaymentsProfileDetails');
    }

    /**
     * (Required) Recurring payments profile ID returned in the
     * CreateRecurringPaymentsProfile response. 19-character profile IDs are
     * supported for compatibility with previous versions of the PayPal API.
     * Character length and limitations: 14 single-byte alphanumeric characters
     *
     * @param $profileId
     */
    public function setProfileId($profileId)
    {
        $this->profileId = $profileId;

        return $this;
    }

    public function getProfileId()
    {
        return $this->profileId;
    }

    /**
     * Validate the minimum set of required values.
     *
     * @return bool
     */
    public function isValid()
    {
        if(is_null($this->profileId)) {
            return false;
        }

        return true;
    }
}