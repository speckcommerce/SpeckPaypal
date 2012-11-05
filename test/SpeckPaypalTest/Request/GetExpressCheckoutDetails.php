<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\GetExpressCheckoutDetails;
use SpeckPaypal\Request;
use SpeckPaypal\Element\ExpressShippingOption;
use Zend\Http\Client\Adapter\Test;


class GetExpressCheckoutDetailsTest extends PHPUnit_Framework_TestCase
{
    public function testMutators()
    {
        $details = new GetExpressCheckoutDetails('token');

        $this->assertEquals($details->getToken(), 'token');
    }

    public function testToArray()
    {
        $details = new GetExpressCheckoutDetails('token');
        $data = $details->toArray();

        $this->assertEquals($data['METHOD'], 'getExpressCheckoutDetails');
        $this->assertEquals($data['TOKEN'], 'token');
    }

    public function testIsValid()
    {
        $details = new GetExpressCheckoutDetails('token');

        $this->assertTrue($details->isValid());

        $details->setToken(null);
        $this->assertFalse($details->isValid());
    }
}