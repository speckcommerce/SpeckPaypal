<?php
namespace SpeckPaypalTest\Element;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Element\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{
    public function testValidConfig()
    {
        $config = new Config(array(
            'username'  => 'username',
            'password'  => 'password',
            'signature' => 'signature',
            'endpoint'  => 'http://endpoint.com',
            'version'   => '58.0'
         ));
        $this->assertEquals($config->getUsername(), 'username');
        $this->assertEquals($config->getPassword(), 'password');
        $this->assertEquals($config->getSignature(), 'signature');
        $this->assertEquals($config->getEndpoint(), 'http://endpoint.com');
        $this->assertEquals($config->getVersion(), '58.0');
        $this->assertEquals($config->__toString(), "VERSION=58.0&PWD=password&USER=username&SIGNATURE=signature");
    }

    public function testInvalidConfig()
    {
        $config = new Config(array());
        $this->assertFalse($config->isValid());

        try {
            $config->__toString();
            $this->fail();
        } catch(\Exception $e) {
            //
            $this->assertEquals($e->getMessage(), 'SpeckPaypal\Element\Config Missing required configuration item.');
        }
    }
}