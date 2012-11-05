<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\SetExpressCheckout;
use SpeckPaypal\Element\PaymentDetails;
use SpeckPaypal\Request;
use SpeckPaypal\Element\Config;
use Zend\Http\Client\Adapter\Test;


class SetExpressCheckoutTest extends PHPUnit_Framework_TestCase
{
    protected $paypalRequest;

    protected $express;

    public function setup()
    {
        $this->paypalRequest = Bootstrap::getServiceManager()->get('SpeckPaypal\Service\Request');

        $express = new SetExpressCheckout(array(
            'paymentDetails' => new PaymentDetails(array('amt' => '10.00'))
        ));
        $express->setMaxAmt('10.00');
        $express->setReturnUrl('http://return.url');
        $express->setCancelUrl('http://cancel.url');
        $express->setCallback('http://callback.url');
        $express->setCallbackTimeout('10');
        $express->setReqConfirmShipping(true);
        $express->setNoShipping(true);
        $express->setAllowNote(true);
        $express->setAddrOverride(true);
        $express->setCallbackVersion('10');
        $express->setLocaleCode('en_GB');
        $express->setPageStyle('page_style');
        $express->setHdrImg('http://hdrimg.url');
        $express->setHdrBorderColor('FFFFFF');
        $express->setPayflowColor('FFFFFF');
        $express->setEmail('test@test.com');
        $express->setSolutionType(SetExpressCheckout::SOLUTION_MARK);
        $express->setLandingPage(SetExpressCheckout::LANDINGPAGE_BILLING);
        $express->setChannelType(SetExpressCheckout::CHANNELTYPE_MERCHANT);
        $express->setGiroPaySuccessUrl('http://giropaysuccess.url');
        $express->setGiroPayCancelUrl('http://giropaycancel.url');
        $express->setBankTxPendingUrl('http://banktxpending.url');
        $express->setBrandName('ACME inc.');
        $express->setCustomerServiceNumber('888-555-4444');
        $express->setGiftMessageEnable(true);
        $express->setGiftReceiptEnable(true);
        $express->setGiftWrapEnable(true);
        $express->setGiftWrapName('Box with ribbon');
        $express->setGiftWrapAmount('1.00');
        $express->setBuyerEmailOptInEnable(true);
        $express->setSurveyQuestion('What color is the sky?');
        $express->setSurveyEnable(true);
        $express->setBuyerId('test');
        $express->setBuyerUsername('buyer_username');
        $express->setBuyerRegistrationDate('2011-06-24T05:38:48Z');
        $express->setAllowPushFunding(true);
        $express->setTaxIdType(SetExpressCheckout::TAXIDTYPE_INDIVIDUAL);
        $express->setTaxId('12345678912');

        $this->express = $express;
    }

    public function testMutators()
    {
        $express = $this->express;

        $this->assertEquals($express->getMaxAmt(), '10.00');
        $this->assertEquals($express->getReturnUrl(), 'http://return.url');
        $this->assertEquals($express->getCancelUrl(), 'http://cancel.url');
        $this->assertEquals($express->getCallback(), 'http://callback.url');
        $this->assertEquals($express->getCallbackTimeout(), '10');
        $this->assertEquals($express->getReqConfirmShipping(), 1);
        $this->assertEquals($express->getNoShipping(), 1);
        $this->assertEquals($express->getAllowNote(), 1);
        $this->assertEquals($express->getAddrOverride(), 1);
        $this->assertEquals($express->getCallbackVersion(), '10');
        $this->assertEquals($express->getLocaleCode(), 'en_GB');
        $this->assertEquals($express->getPageStyle(), 'page_style');
        $this->assertEquals($express->getHdrImg(), 'http://hdrimg.url');
        $this->assertEquals($express->getHdrBorderColor(), 'FFFFFF');
        $this->assertEquals($express->getPayflowColor(), 'FFFFFF');
        $this->assertEquals($express->getEmail(), 'test@test.com');
        $this->assertEquals($express->getSolutionType(), SetExpressCheckout::SOLUTION_MARK);
        $this->assertEquals($express->getLandingPage(), SetExpressCheckout::LANDINGPAGE_BILLING);
        $this->assertEquals($express->getChannelType(), SetExpressCheckout::CHANNELTYPE_MERCHANT);
        $this->assertEquals($express->getGiroPaySuccessUrl(), 'http://giropaysuccess.url');
        $this->assertEquals($express->getGiroPayCancelUrl(), 'http://giropaycancel.url');
        $this->assertEquals($express->getBankTxPendingUrl(), 'http://banktxpending.url');
        $this->assertEquals($express->getBrandName(), 'ACME inc.');
        $this->assertEquals($express->getCustomerServiceNumber(), '888-555-4444');
        $this->assertEquals($express->getGiftMessageEnable(), 1);
        $this->assertEquals($express->getGiftReceiptEnable(), 1);
        $this->assertEquals($express->getGiftWrapEnable(), 1);
        $this->assertEquals($express->getGiftWrapName(), 'Box with ribbon');
        $this->assertEquals($express->getGiftWrapAmount(), '1.00');
        $this->assertEquals($express->getBuyerEmailOptInEnable(), 1);
        $this->assertEquals($express->getSurveyQuestion(), 'What color is the sky?');
        $this->assertEquals($express->getSurveyEnable(), 1);
        $this->assertEquals($express->getBuyerId(), 'test');
        $this->assertEquals($express->getBuyerUsername(), 'buyer_username');
        $this->assertEquals($express->getBuyerRegistrationDate(), '2011-06-24T05:38:48Z');
        $this->assertEquals($express->getAllowPushFunding(), 1);
        $this->assertEquals($express->getTaxIdType(), SetExpressCheckout::TAXIDTYPE_INDIVIDUAL);
        $this->assertEquals($express->getTaxId(), '12345678912');
    }

    public function testToArray()
    {
        $express = $this->express;

        $data = $express->toArray();
        $this->assertEquals($data['MAXAMT'], '10.00');
        $this->assertEquals($data['RETURNURL'], 'http://return.url');
        $this->assertEquals($data['CANCELURL'], 'http://cancel.url');
        $this->assertEquals($data['CALLBACK'], 'http://callback.url');
        $this->assertEquals($data['CALLBACKTIMEOUT'], '10');
        $this->assertEquals($data['REQCONFIRMSHIPPING'], 1);
        $this->assertEquals($data['NOSHIPPING'], 1);
        $this->assertEquals($data['ALLOWNOTE'], 1);
        $this->assertEquals($data['ADDROVERRIDE'], 1);
        $this->assertEquals($data['CALLBACKVERSION'], '10');
        $this->assertEquals($data['LOCALECODE'], 'en_GB');
        $this->assertEquals($data['PAGESTYLE'], 'page_style');
        $this->assertEquals($data['HDRIMG'], 'http://hdrimg.url');
        $this->assertEquals($data['HDRBORDERCOLOR'], 'FFFFFF');
        $this->assertEquals($data['PAYFLOWCOLOR'], 'FFFFFF');
        $this->assertEquals($data['EMAIL'], 'test@test.com');
        $this->assertEquals($data['SOLUTIONTYPE'], SetExpressCheckout::SOLUTION_MARK);
        $this->assertEquals($data['LANDINGPAGE'], SetExpressCheckout::LANDINGPAGE_BILLING);
        $this->assertEquals($data['CHANNELTYPE'], SetExpressCheckout::CHANNELTYPE_MERCHANT);
        $this->assertEquals($data['GIROPAYSUCCESSURL'], 'http://giropaysuccess.url');
        $this->assertEquals($data['GIROPAYCANCELURL'], 'http://giropaycancel.url');
        $this->assertEquals($data['BANKTXPENDINGURL'], 'http://banktxpending.url');
        $this->assertEquals($data['BRANDNAME'], 'ACME inc.');
        $this->assertEquals($data['CUSTOMERSERVICENUMBER'], '888-555-4444');
        $this->assertEquals($data['GIFTMESSAGEENABLE'], 1);
        $this->assertEquals($data['GIFTRECEIPTENABLE'], 1);
        $this->assertEquals($data['GIFTWRAPENABLE'], 1);
        $this->assertEquals($data['GIFTWRAPNAME'], 'Box with ribbon');
        $this->assertEquals($data['GIFTWRAPAMOUNT'], '1.00');
        $this->assertEquals($data['BUYEREMAILOPTINENABLE'], 1);
        $this->assertEquals($data['SURVEYQUESTION'], 'What color is the sky?');
        $this->assertEquals($data['SURVEYENABLE'], 1);
        $this->assertEquals($data['BUYERID'], 'test');
        $this->assertEquals($data['BUYERUSERNAME'], 'buyer_username');
        $this->assertEquals($data['BUYERREGISTRATIONDATE'], '2011-06-24T05:38:48Z');
        $this->assertEquals($data['ALLOWPUSHFUNDING'], 1);
        $this->assertEquals($data['TAXIDTYPE'], SetExpressCheckout::TAXIDTYPE_INDIVIDUAL);
        $this->assertEquals($data['TAXID'], '12345678912');
    }

    public function testIsValid()
    {
        $express = $this->express;

        $this->assertTrue($express->isValid());

        $clone = clone $express;
        $clone->setReturnUrl(null);
        $this->assertFalse($clone->isvalid());

        $clone = clone $express;
        $clone->setCancelUrl(null);
        $this->assertFalse($clone->isvalid());

        $clone = clone $express;
        $clone->setPaymentDetails(null);
        $this->assertFalse($clone->isvalid());

        $clone = clone $express;
        $clone->setPaymentDetails(new PaymentDetails());
        $this->assertFalse($clone->isvalid());
    }

    /**
     * Uncomment below to do an integration test with Paypal Sandbox API
     *
    public function testSetExpressCheckoutWithMinimumRequiredFields()
    {
        $express = new SetExpressCheckout(new PaymentDetails('20.00'));
        $express->setReturnUrl('http://www.someurl.com');
        $express->setCancelUrl('http://www.someurl.com');

        $paypal = $this->paypalRequest;
        $paypal->getClient()->setAdapter($adapter);


        $response = $paypal->send($express);
//        var_dump($paypal->getClient()->getLastRawRequest());
//        var_dump($paypal->getClient()->getLastRawResponse());
//        var_dump($response);

        $this->assertTrue($response->isSuccess());
    }
    */
}