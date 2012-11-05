<?php
namespace SpeckPaypalTest\Element;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Element\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    protected $configArray;

    public function setup()
    {
        $this->configArray = array(
            'username'  => 'username',
            'password'  => 'password',
            'signature' => 'signature',
            'endpoint'  => 'http://endpoint.com'
        );
    }

    public function testValidConfig()
    {
        $config = new Config($this->configArray);
        $this->assertEquals($config->getUsername(), 'username');
        $this->assertEquals($config->getPassword(), 'password');
        $this->assertEquals($config->getSignature(), 'signature');
        $this->assertEquals($config->getEndpoint(), 'http://endpoint.com');
        $this->assertEquals($config->__toString(), "VERSION=95.0&PWD=password&USER=username&SIGNATURE=signature");
    }

    public function testInvalidConfig()
    {
        $config = new Config(array());
        $this->assertFalse($config->isValid());

        $config = new Config($this->configArray);
        $this->assertTrue($config->isValid());
    }
}