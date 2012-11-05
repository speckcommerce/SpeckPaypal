<?php
namespace SpeckPaypal\Element;

use SpeckPaypal\Element\AbstractElement;

class ExpressShippingOption extends AbstractElement
{
    protected $_index;

    protected $default = 'true';
    protected $name;
    protected $label;
    protected $amount;
    protected $taxAmount = 0;
    protected $insuranceAmount = 0;


    /**
     * Shipping option. Required if specifying the Callback URL.
     * The amount of the flat rate shipping option.
     * Limitations: Must not exceed $10,000 USD in any currency. No currency symbol.
     * Must have two decimal places, decimal separator must be a period (.), and the
     * optional thousands separator must be a comma (,).
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function setInsuranceAmount($insuranceAmount)
    {
        $this->insuranceAmount = $insuranceAmount;
    }

    /**
     * Shipping option. Required if specifying the Callback URL.
     * The label for the shipping option as displayed to the user. Examples include: Air:
     * Next Day, Expedited: 3-5 days, Ground: 5-7 days, and so forth. Shipping option
     * labels can be localized based on the buyerís locale, which PayPal sends to your
     * website as a parameter value in the callback request.
     * Character length and limitations: 50 character-string.
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Shipping option. Required if specifying the Callback URL.
     * The internal name of the shipping option such as Air, Ground, Expedited, and so
     * forth.
     * Character length and limitations: 50 character-string
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }

    public function setIndex($index)
    {
        $this->_index = $index;
    }

    /**
     *	Shipping option. Required if specifying the Callback URL.
     *	When the value of this flat rate shipping option is true, PayPal selects it by default
     *	for the buyer and reflects it in the ìdefaultî total.
     *	NOTE: There must be ONE and ONLY ONE default. It is not OK to have no default.
     *	Character length and limitations: Boolean: true or false.
     */
    public function getDefault()
    {
        return $this->default;
    }

    public function setDefault($default)
    {
        $this->default = ($default) ? 'true' : 'false';

        return $this;
    }

    public function getIndex()
    {
        return $this->_index;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getInsuranceAmount()
    {
        return $this->insuranceAmount;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTaxAmount()
    {
        return $this->taxAmount;
    }
}