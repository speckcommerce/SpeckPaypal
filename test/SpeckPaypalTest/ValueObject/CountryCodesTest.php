<?php
namespace SpeckPaypalTest\ValueObject;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\ValueObject\CountryCodes;

class CountryCodesTest extends PHPUnit_Framework_TestCase
{
    public function testCanGetCodeByCountryName()
    {
        $this->assertEquals(CountryCodes::getCodeByName('United States'), 'US');
    }

    public function testCanGetCountryNameByCode()
    {
        $this->assertEquals(CountryCodes::getNameByCode('US'), 'UNITED STATES');
    }

    public function testCountryIsValid()
    {
        $this->assertTrue(CountryCodes::isValid('US'));
        $this->assertTrue(CountryCodes::isValid('UNITED STATES'));
        $this->assertFalse(CountryCodes::isValid('California'));
    }

    public function testNameToCodeArray()
    {
        $countries = CountryCodes::getNameToCodeArray();
        $this->assertEquals($countries['UNITED STATES'], 'US');
    }

    public function testCodeToNameArray()
    {
        $countries = CountryCodes::getCodeToNameArray();
        $this->assertEquals($countries['US'], 'UNITED STATES');
    }
}