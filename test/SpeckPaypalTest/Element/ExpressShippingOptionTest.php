<?php
namespace SpeckPaypalTest\Element;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Element\ExpressShippingOption;

class ExpressShippingOptionTest extends PHPUnit_Framework_TestCase
{
    protected $option;

    public function setup()
    {
        $option = new ExpressShippingOption;
        $option->setDefault(1);
        $option->setName('name');
        $option->setLabel('label');
        $option->setAmount('10.00');
        $option->setTaxAmount('1.00');
        $option->setInsuranceAmount('1.00');

        $this->option = $option;

    }

    public function testMutators()
    {
        $option = $this->option;

        $this->assertEquals($option->getDefault(), 'true');
        $this->assertEquals($option->getName(), 'name');
        $this->assertEquals($option->getLabel(), 'label');
        $this->assertEquals($option->getAmount(), '10.00');
        $this->assertEquals($option->getTaxAmount(), '1.00');
        $this->assertEquals($option->getInsuranceAmount(), '1.00');
    }

    public function testToArray()
    {
        $option = $this->option;
        $data = $option->toArray();
        $this->assertEquals($data['DEFAULT'], 'true');
        $this->assertEquals($data['NAME'], 'name');
        $this->assertEquals($data['LABEL'], 'label');
        $this->assertEquals($data['AMOUNT'], '10.00');
        $this->assertEquals($data['TAXAMOUNT'], '1.00');
        $this->assertEquals($data['INSURANCEAMOUNT'], '1.00');
    }
}