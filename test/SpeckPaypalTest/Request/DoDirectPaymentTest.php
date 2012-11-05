<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\DoDirectPayment;
use SpeckPaypal\Element\Address;
use SpeckPaypal\Element\Config;
use SpeckPaypal\Request;
use SpeckPaypal\Request\DoCapture;
use Zend\Http\Client\Adapter\Test;

class DoDirectPaymentTest extends PHPUnit_Framework_TestCase
{
    protected $serviceManager;

    protected $paypalRequest;

    protected $payment;
    public function setup()
    {
        $this->paypalRequest = Bootstrap::getServiceManager()->get('SpeckPaypal\Service\Request');

        $payment = new DoDirectPayment(array(
            'paymentDetails' => new \SpeckPaypal\Element\PaymentDetails(array('amt'=> '10.00'))
        ));
        $payment->setCardNumber('4744151425799438');
        $payment->setExpirationDate('112017');
        $payment->setFirstName('John');
        $payment->setLastName('Canyon');
        $payment->setEmail('test@test.com');
        $payment->setIpAddress('255.255.255.255');
        $payment->setReturnFmfDetails(1);
        $payment->setCreditCardType('Visa');
        $payment->setStartDate('122012');
        $payment->setCvv2('345');
        $payment->setIssueNumber('12');

        $address = new Address;
        $address->setStreet('27 nowhere');
        $address->setState('California');
        $address->setCity('Ventura');
        $address->setZip(92656);
        $address->setCountry('US');
        $address->setPhoneNum('999-999-9999');

        $payment->setAddress($address);
        $payment->setShipAddress(clone $address);

        $this->payment = $payment;


    }

    public function testMutators()
    {
        $payment = $this->payment;
        $this->assertEquals($payment->getCardNumber(),'4744151425799438');
        $this->assertEquals($payment->getExpirationDate(),'112017');
        $this->assertEquals($payment->getFirstName(),'John');
        $this->assertEquals($payment->getLastName(),'Canyon');
        $this->assertEquals($payment->getEmail(),'test@test.com');
        $this->assertEquals($payment->getIpAddress(),'255.255.255.255');
        $this->assertEquals($payment->getReturnFmfDetails(), 1);
        $this->assertEquals($payment->getCreditCardType(),'Visa');
        $this->assertEquals($payment->getStartDate(),'122012');
        $this->assertEquals($payment->getCvv2(),'345');
        $this->assertEquals($payment->getIssueNumber(),'12');

        $address = $payment->getAddress();
        $this->assertEquals($address->getStreet(), '27 nowhere');
        $this->assertEquals($address->getState(), 'California');
        $this->assertEquals($address->getCity(), 'Ventura');
        $this->assertEquals($address->getZip(), 92656);
        $this->assertEquals($address->getCountryCode(), 'US');
        $this->assertEquals($address->getPhoneNum(), '999-999-9999');

        $address = $payment->getShipAddress();
        $this->assertEquals($address->getStreet(), '27 nowhere');
        $this->assertEquals($address->getState(), 'California');
        $this->assertEquals($address->getCity(), 'Ventura');
        $this->assertEquals($address->getZip(), 92656);
        $this->assertEquals($address->getCountryCode(), 'US');
        $this->assertEquals($address->getPhoneNum(), '999-999-9999');

    }

    public function testToArray()
    {
        $payment = $this->payment;
        $data = $payment->toArray();
        $this->assertEquals($data['ACCT'],'4744151425799438');
        $this->assertEquals($data['EXPDATE'],'112017');
        $this->assertEquals($data['FIRSTNAME'],'John');
        $this->assertEquals($data['LASTNAME'],'Canyon');
        $this->assertEquals($data['EMAIL'],'test@test.com');
        $this->assertEquals($data['IPADDRESS'],'255.255.255.255');
        $this->assertEquals($data['RETURNFMFDETAILS'], 1);
        $this->assertEquals($data['CREDITCARDTYPE'],'Visa');
        $this->assertEquals($data['STARTDATE'],'122012');
        $this->assertEquals($data['CVV2'],'345');
        $this->assertEquals($data['ISSUENUMBER'],'12');

        $this->assertEquals($data['STREET'],'27 nowhere');
        $this->assertEquals($data['STATE'],'California');
        $this->assertEquals($data['CITY'],'Ventura');
        $this->assertEquals($data['ZIP'],'92656');
        $this->assertEquals($data['COUNTRYCODE'],'US');
        $this->assertEquals($data['SHIPTOPHONENUM'],'999-999-9999');

        $this->assertEquals($data['SHIPTOSTREET'],'27 nowhere');
        $this->assertEquals($data['SHIPTOSTATE'],'California');
        $this->assertEquals($data['SHIPTOCITY'],'Ventura');
        $this->assertEquals($data['SHIPTOZIP'],'92656');
        $this->assertEquals($data['SHIPTOCOUNTRYCODE'],'US');
    }

    public function testIsValid()
    {
        $payment = $this->payment;

        $this->assertTrue($payment->isValid());

        $clone = clone $payment;
        $clone->setIpAddress(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $payment;
        $clone->setFirstName(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $payment;
        $clone->setLastName(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $payment;
        $clone->setAddress(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $payment;
        $clone->setPaymentDetails(null);
        $this->assertFalse($clone->isValid());
    }

    /**
     * Uncomment below methods to test against Paypal sandbox API  the below is for integration tests.
     * @todo create new test folder for integration tests.
     *
    public function testDirectPaymentSaleIntegration()
    {
        $payment = new DoDirectPayment(array('paymentDetails' => new \SpeckPaypal\Element\PaymentDetails('10.00')));

        $payment->setCardNumber('4744151425799438');
        $payment->setExpirationDate('112017');
        $payment->setFirstName('John');
        $payment->setLastName('Canyon');

        $address = new Address;
        $address->setStreet('27 nowhere');
        $address->setState('California');
        $address->setZip(92656);
        $address->setCountry('US');
        $address->setPhoneNum('999-999-9999');

        $payment->setAddress($address);

        $paypal = $this->paypalRequest;

        $response = $paypal->send($payment);
//        var_dump($paypal->getClient()->getLastRawRequest());
//        var_dump($paypal->getClient()->getLastRawResponse());

        $this->assertTrue($response->isSuccess());
    }

    public function testDirectPaymentAuthorizeAndCaptureIntegration()
    {
        $payment = new DoDirectPayment(array('paymentDetails' => new \SpeckPaypal\Element\PaymentDetails('10.00')));
        $payment->setCardNumber('4744151425799438');
        $payment->setExpirationDate('112017');
        $payment->setPaymentAction(Payment::AUTHORIZATION);

        $this->assertEquals($payment->getPaymentAction(), Payment::AUTHORIZATION);

        $address = new Address;
        $address->setStreet('27 nowhere');
        $address->setState('California');
        $address->setZip(92656);
        $address->setCountry('US');

        $payment->setAddress($address);

        $paypal = $paypal = $this->paypalRequest;
        $response = $paypal->send($payment);
        $this->assertTrue($response->isSuccess());
//        var_dump($paypal->getClient()->getLastRawRequest());
//        var_dump($paypal->getClient()->getLastRawResponse());

        $adapter = new Test;

        //setup a Capture
        $capture = new DoCapture(array(
            'transactionId' => $response->getTransactionId(),
            'amt' => '10.00'
        ));

        $response = $paypal->send($capture);
        $this->assertTrue($response->isSuccess());
    }
    */
}