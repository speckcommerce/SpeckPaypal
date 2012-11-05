<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Element\Address;
use SpeckPaypal\Element\Config;
use SpeckPaypal\Element\PaymentDetails;
use SpeckPaypal\Request\DoDirectPayment;
use SpeckPaypal\Request\DoVoid;
use Zend\Http\Client\Adapter\Test;

class DoVoidTest extends PHPUnit_Framework_TestCase
{
    protected $void;
    public function setup()
    {
        $void = new DoVoid();
        $void->setAuthorizationId('12345');
        $void->setNote('voided');
        $void->setMsgSubId('1');
        $this->void = $void;
    }

    public function testMutators()
    {
        $void = $this->void;

        $this->assertEquals($void->getAuthorizationId(), '12345');
        $this->assertEquals($void->getNote(), 'voided');
        $this->assertEquals($void->getMsgSubId(), '1');
    }

    public function testToArray()
    {
        $data = $this->void->toArray();

        $this->assertEquals($data['METHOD'], 'DoVoid');
        $this->assertEquals($data['AUTHORIZATIONID'], '12345');
        $this->assertEquals($data['NOTE'], 'voided');
        $this->assertEquals($data['MSGSUBID'], '1');
    }

    public function testIsValid()
    {
        $void = $this->void;

        $this->assertTrue($void->isValid());

        $void->setAuthorizationId(null);
        $this->assertFalse($void->isValid());
    }

    /**
     * uncomment to run integration test against the paypal API
     *
    public function testIntegration()
    {
        $request = Bootstrap::buildPaypalRequest();

        $payment = new DoDirectPayment();
        $payment->setPaymentDetails(new PaymentDetails(array(
            'amt' => '10.00',
            'paymentAction' => PaymentDetails::AUTHORIZATION
        )));

        //for integration you will need to replace this CC number and Exp with the numbner
        //provided by the paypal test accounts.
        $payment->setCardNumber('4839059748301467');
        $payment->setExpirationDate('112019');
        $payment->setFirstName('John');
        $payment->setLastName('Canyon');
        $payment->setIpAddress('192.168.1.105');
        $payment->setCreditCardType('Visa');

        $address = new Address;
        $address->setStreet('27 nowhere');
        $address->setState('California');
        $address->setCity('Ventura');
        $address->setZip(92656);
        $address->setCountry('US');

        $payment->setAddress($address);

        $response = $request->send($payment);
        var_dump($request->getClient()->getLastRawRequest());
        var_dump($request->getClient()->getLastRawResponse());
        var_dump($response);
        $this->assertTrue($response->isSuccess());

        $void = new DoVoid;
        $void->setAuthorizationId($response->getTransactionId());

        $response = $request->send($void);
        var_dump($request->getClient()->getLastRawResponse());
        var_dump($response);
        $this->assertTrue($response->isSuccess());
    }
    */
}