<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\Callback;
use SpeckPaypal\Request;
use SpeckPaypal\Element\ExpressShippingOption;
use Zend\Http\Client\Adapter\Test;


class CallbackTest extends PHPUnit_Framework_TestCase
{
    public function testMutators()
    {
        $callback = new Callback();
        $callback->setToken('sometoken');
        $callback->setCurrencyCode('USD');
        $callback->setOfferInsuranceOption('true');

        $this->assertEquals($callback->getToken(), 'sometoken');
        $this->assertEquals($callback->getCurrencyCode(), 'USD');
        $this->assertEquals($callback->getOfferInsuranceOption(), 'true');
    }

    public function testToArray()
    {
        $callback = new Callback();
        $callback->setToken('sometoken');
        $callback->setCurrencyCode('USD');
        $callback->setOfferInsuranceOption('true');

        $shippingOptions = new ExpressShippingOption();
        $shippingOptions->setName('Some Name');
        $shippingOptions->setAmount('10.00');
        $shippingOptions->setDefault(1);

        $callback->setShippingOptions($shippingOptions);

        $data = $callback->toArray();

        $this->assertEquals($data['TOKEN'], 'sometoken');
        $this->assertEquals($data['CURRENCYCODE'], 'USD');
        $this->assertEquals($data['OFFERINSURANCEOPTION'], 'true');
        $this->assertEquals($data['L_SHIPPINGOPTIONNAME0'], 'Some Name');
        $this->assertEquals($data['L_SHIPPINGOPTIONAMOUNT0'], '10.00');
        $this->assertEquals($data['L_SHIPPINGOPTIONISDEFAULT0'], 'true');
    }

    public function testIsValid()
    {
        $callback = new Callback();
        $callback->setToken('sometoken');
        $callback->setCurrencyCode('USD');
        $callback->setOfferInsuranceOption('true');

        $shippingOptions = new ExpressShippingOption();
        $shippingOptions->setName('Some Name');
        $shippingOptions->setLabel('Some Label');
        $shippingOptions->setAmount('10.00');
        $shippingOptions->setDefault(1);

        $callback->setShippingOptions($shippingOptions);

        $this->assertTrue($callback->isValid());

        $clone = clone $callback;
        $clone->setCurrencyCode(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $callback;
        $options = clone $shippingOptions;
        $options->setName(null);
        $clone->setShippingOptions($options);
        $this->assertFalse($clone->isValid());
    }
}