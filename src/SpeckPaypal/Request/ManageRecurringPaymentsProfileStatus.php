<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;

class ManageRecurringPaymentsProfileStatus extends AbstractRequest
{
    protected $profileId;
    protected $action;
    protected $note;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('ManageRecurringPaymentsProfileStatus');
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

    /**
     * (Required) The action to be performed to the recurring payments profile.
     * Must be one of the following: 
     * Cancel – Only profiles in Active or Suspended state can be canceled.
     * Suspend – Only profiles in Active state can be suspended.
     * Reactivate – Only profiles in a suspended state can be reactivated.
     *
     * @param $action
     */
    public function setAction($action)
    {
        if(!in_array($action, array('Cancel', 'Suspend', 'Reactivate'))) {
            throw new \Exception('Invalid action passed.');
        }

        $this->action = $action;

        return $this;
    }

    /**
     * (Optional) The reason for the change in status. For profiles created
     * using Express Checkout, this message is included in the email
     * notification to the buyer when the status of the profile is successfully
     * changed, and can also be seen by both you and the buyer on the Status
     * History page of the PayPal account.
     *
     * @param $note
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    public function getProfileId()
    {
        return $this->profileId;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getNote()
    {
        return $this->note;
    }

    /**
     * Validate the minimum set of required values.
     *
     * @return bool
     */
    public function isValid()
    {
        if(is_null($this->profileId) || is_null($this->action)) {
            return false;
        }

        return true;
    }
}