<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\DoExpressCheckoutPayment;
use SpeckPaypal\Request;
use SpeckPaypal\Element\PaymentDetails;
use Zend\Http\Client\Adapter\Test;


class DoExpressCheckoutPaymentTest extends PHPUnit_Framework_TestCase
{
    protected $express;

    function setup()
    {
        $express = new DoExpressCheckoutPayment(array(
            'token' => 'asdf',
            'payerId' => 'payerid',
            'paymentDetails' => new PaymentDetails(array('amt'=>'10.00'))
        ));
        $express->setReturnFmfDetails('true');
        $express->setGiftMessage('a gift message');
        $express->setGiftReceiptEnable(true);
        $express->setGiftWrapName('ribbon on box');
        $express->setGiftWrapAmount('1.00');
        $express->setBuyerMarketingEmail('buyer@somedomain.com');
        $express->setSurveyQuestion('what color is red?');
        $express->setSurveyChoiceSelected('red');
        $express->setButtonSource('button_source');
        $express->setInsuranceOptionSelected(true);
        $express->setShippingOptionIsDefault(true);
        $express->setShippingOptionAmount('20.00');
        $express->setShippingOptionName('ground');

        $this->express = $express;
    }

    public function testMutators()
    {
        $express = $this->express;

        $this->assertEquals($express->getToken(), 'asdf');
        $this->assertEquals($express->getPayerId(), 'payerid');
        $this->assertEquals($express->getGiftMessage(), 'a gift message');
        $this->assertEquals($express->getGiftReceiptEnable(), 1);
        $this->assertEquals($express->getGiftWrapName(), 'ribbon on box');
        $this->assertEquals($express->getGiftWrapAmount(), '1.00');
        $this->assertEquals($express->getBuyerMarketingEmail(), 'buyer@somedomain.com');
        $this->assertEquals($express->getSurveyQuestion(), 'what color is red?');
        $this->assertEquals($express->getSurveyChoiceSelected(), 'red');
        $this->assertEquals($express->getButtonSource(), 'button_source');
        $this->assertEquals($express->getInsuranceOptionSelected(), 1);
        $this->assertEquals($express->getShippingOptionIsDefault(), 1);
        $this->assertEquals($express->getShippingOptionAmount(), '20.00');
        $this->assertEquals($express->getShippingOptionName(), 'ground');
    }

    public function testToArray()
    {
        $express = $this->express;
        $data = $express->toArray();
        $this->assertEquals($data['TOKEN'], 'asdf');
        $this->assertEquals($data['PAYERID'], 'payerid');
        $this->assertEquals($data['GIFTMESSAGE'], 'a gift message');
        $this->assertEquals($data['GIFTRECEIPTENABLE'], 1);
        $this->assertEquals($data['GIFTWRAPNAME'], 'ribbon on box');
        $this->assertEquals($data['GIFTWRAPAMOUNT'], '1.00');
        $this->assertEquals($data['BUYERMARKETINGEMAIL'], 'buyer@somedomain.com');
        $this->assertEquals($data['SURVEYQUESTION'], 'what color is red?');
        $this->assertEquals($data['SURVEYCHOICESELECTED'], 'red');
        $this->assertEquals($data['BUTTONSOURCE'], 'button_source');
        $this->assertEquals($data['INSURANCEOPTIONSELECTED'], 1);
        $this->assertEquals($data['SHIPPINGOPTIONISDEFAULT'], 1);
        $this->assertEquals($data['SHIPPINGOPTIONAMOUNT'], '20.00');
        $this->assertEquals($data['SHIPPINGOPTIONNAME'], 'ground');
    }

    public function testIsValid()
    {
        $express = $this->express;
        $this->assertTrue($express->isValid());

        $clone = clone $express;
        $clone->setToken(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $express;
        $clone->setPayerId(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $express;
        $clone->setPaymentDetails(new PaymentDetails());
        $this->assertFalse($clone->isvalid());
    }
}