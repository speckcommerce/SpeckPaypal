<?php
namespace SpeckPaypalTest\Element;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Element\PaymentDetails;
use SpeckPaypal\Element\Address;

class PaymentDetailsTest extends PHPUnit_Framework_TestCase
{
    protected $details;
    public function setup()
    {
        $details = new PaymentDetails(array('amt' => '10.00'));
        $details->setSellerPaypalAccountId('123456');
        $details->setItemAmt('10.00');
        $details->setShippingAmt('10.00');
        $details->setInsuranceAmt('1.00');
        $details->setShipDiscAmt('5.00');
        $details->setInsuranceOptionOffered(true);
        $details->setHandlingAmt('1.00');
        $details->setTaxAmt('1.00');
        $details->setDesc('description');
        $details->setCustom('custom');
        $details->setInvNum('1234');
        $details->setNotifyUrl('http://notify.url');
        $details->setNoteText('note');
        $details->setTransactionId('1234');
        $details->setAllowedPaymentMethod('InstantPaymentOnly');
        $details->setPaymentRequestId('1234');
        $details->setPaymentReason('None');
        $details->setButtonSource('http://buttonsource.url');
        $details->setRecurring(true);

        $this->details = $details;
    }

    public function testMutators()
    {
        $details = $this->details;

        $this->assertEquals($details->getAmt(), '10.00');
        $this->assertEquals($details->getSellerPaypalAccountId(), '123456');
        $this->assertEquals($details->getItemAmt(), '10.00');
        $this->assertEquals($details->getShippingAmt(), '10.00');
        $this->assertEquals($details->getInsuranceAmt(), '1.00');
        $this->assertEquals($details->getShipDiscAmt(), '5.00');
        $this->assertEquals($details->getInsuranceOptionOffered(), '1');
        $this->assertEquals($details->getHandlingAmt(), '1.00');
        $this->assertEquals($details->getTaxAmt(), '1.00');
        $this->assertEquals($details->getDesc(), 'description');
        $this->assertEquals($details->getCustom(), 'custom');
        $this->assertEquals($details->getInvNum(), '1234');
        $this->assertEquals($details->getNotifyUrl(), 'http://notify.url');
        $this->assertEquals($details->getNoteText(), 'note');
        $this->assertEquals($details->getTransactionId(), '1234');
        $this->assertEquals($details->getAllowedPaymentMethod(), 'InstantPaymentOnly');
        $this->assertEquals($details->getPaymentRequestId(), '1234');
        $this->assertEquals($details->getPaymentReason(), 'None');
        $this->assertEquals($details->getButtonSource(), 'http://buttonsource.url');
        $this->assertEquals($details->getRecurring(), 'Y');
    }

    public function testToArray()
    {
        $details = $this->details;
        $data = $details->toArray();

        $this->assertEquals($data['AMT'], '10.00');
    }

    public function testToArrayWithPrefix()
    {
        $details = $this->details;
        $details->setPrefix('PAYMENTREQUEST_0_');

        $address = new Address;
        $address->setName('John Canyon');

        $details->setAddress($address);
        $data = $details->toArray();

        $this->assertEquals($data['PAYMENTREQUEST_0_AMT'], '10.00');
        $this->assertEquals($data['PAYMENTREQUEST_0_NAME'], 'John Canyon');
    }
}