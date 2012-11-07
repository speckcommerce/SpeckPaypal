<?php
namespace SpeckPaypalTest\Service;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Service\Request;
use SpeckPaypal\Element\Config;
use SpeckPaypal\Element\Address;
use SpeckPaypal\Request\DoDirectPayment;
use Zend\Http\Client\Adapter\Test;

class RequestTest extends PHPUnit_Framework_TestCase
{
    protected $request;

    public function __construct()
    {
        $this->request = Bootstrap::getServiceManager()->get('SpeckPaypal\Service\Request');
    }

    public function testMutators()
    {
        $request = $this->request;

        $this->assertTrue($request->getClient() instanceof \Zend\Http\Client);
        $this->assertTrue($request->getConfig() instanceof Config);
    }

    public function testValidRequest()
    {
        $request = $this->request;
        $payment = new DoDirectPayment(array('paymentDetails' => new \SpeckPaypal\Element\PaymentDetails(array('amt' => '10.00'))));
        $payment->setIpAddress('255.255.255.255');
        $payment->setCardNumber('4744151425799438');
        $payment->setExpirationDate('112017');
        $payment->setFirstName('John');
        $payment->setLastName('Canyon');

        $address = new Address;
        $address->setStreet('27 nowhere');
        $address->setCity('Ventura');
        $address->setState('California');
        $address->setZip(92656);
        $address->setCountry('US');
        $address->setPhoneNum('999-999-9999');

        $payment->setAddress($address);

        $adapter = new Test;
        $adapter->setResponse("HTTP/1.1 200 OK
Date: Fri, 02 Nov 2012 06:11:12 GMT
Server: Apache
Content-Length: 190
Connection: close
Content-Type: text/plain; charset=utf-8

TIMESTAMP=2012%2d11%2d02T06%3a11%3a17Z&CORRELATIONID=ee90a747f2bdb&ACK=Success&VERSION=58%2e0&BUILD=4137385&AMT=10%2e00&CURRENCYCODE=USD&AVSCODE=X&CVV2MATCH=M&TRANSACTIONID=2SB740637D241141K"
        );

        $request->getClient()->setAdapter($adapter);
        $response = $request->send($payment);
        $this->assertTrue($response instanceof \SpeckPaypal\Response\Response);
        $this->assertTrue($response->isSuccess(), current($response->getErrorMessages()));
    }

    public function testInvalidRequest()
    {
        $request = $this->request;
        $payment = new DoDirectPayment(array('paymentDetails' => new \SpeckPaypal\Element\PaymentDetails(array('amt' => '10.00'))));

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

        $adapter = new Test;
        $adapter->setResponse("HTTP/1.1 200 OK
Date: Fri, 02 Nov 2012 23:41:44 GMT
Server: Apache
Content-Length: 146
Connection: close
Content-Type: text/plain; charset=utf-8

ACK=Failure&L_ERRORCODE0=81002&L_SHORTMESSAGE0=Unspecified%20Method&L_LONGMESSAGE0=Method%20Specified%20is%20not%20Supported&L_SEVERITYCODE0=Error"
        );

        $request->getClient()->setAdapter($adapter);
        $response = $request->send($payment);

        $this->assertFalse($response->isSuccess());


    }
}