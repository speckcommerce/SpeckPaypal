<?php
namespace SpeckPaypalTest\Element;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Element\Address;

class AddressTest extends PHPUnit_Framework_TestCase
{
    protected $address;

    public function setup()
    {
        $address = new Address;
        $address->setStreet('27 nowhere');
        $address->setStreet2('Apt 23');
        $address->setState('California');
        $address->setZip('92656');
        $address->setCountry('United States');
        $address->setPhoneNum('949-555-4884');
        $address->setName('John Canyon');

        $this->address = $address;
    }

    public function testMutators()
    {
        $address = $this->address;

        $this->assertEquals($address->getName(), 'John Canyon');
        $this->assertEquals($address->getPhoneNum(), '949-555-4884');
        $this->assertEquals($address->getStreet(),  '27 nowhere');
        $this->assertEquals($address->getStreet2(),  'Apt 23');
        $this->assertEquals($address->getState(),   'California');
        $this->assertEquals($address->getZip(),     '92656');
        $this->assertEquals($address->getCountryCode(), 'US');

        //test setting country with 2 letters
        $address->setCountry('US');
        $this->assertEquals($address->getCountryCode(), 'US');
    }

    public function testToArray()
    {
        $address = $this->address;
        $data = $address->toArray();

        $this->assertEquals($data['NAME'], 'John Canyon');
        $this->assertEquals($data['PHONENUM'], '949-555-4884');
        $this->assertEquals($data['STREET'],  '27 nowhere');
        $this->assertEquals($data['STREET2'],  'Apt 23');
        $this->assertEquals($data['STATE'],   'California');
        $this->assertEquals($data['ZIP'],     '92656');
        $this->assertEquals($data['COUNTRYCODE'], 'US');
    }

    public function testAddressWithInvalidCountry()
    {
        $error = false;
        try {
            $address = new Address;
            $address->setCountry('ASD');
        } catch(\Exception $e) {
            $error = true;
        }
        $this->assertTrue($error);
    }
}