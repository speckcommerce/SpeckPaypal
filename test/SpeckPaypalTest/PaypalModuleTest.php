<?php
namespace SpeckPaypalTest;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;

class PaypalModuleTest extends PHPUnit_Framework_TestCase
{
    public function testCanGetValidPaypalRequestFromSM()
    {
        $sm = Bootstrap::getServiceManager();
        $config = $sm->get('application')->getConfig();
        $this->assertTrue(isset($config['speck-paypal-api']));

        $config = $config['speck-paypal-api'];
        $this->assertTrue(array_key_exists('username', $config));
        $this->assertTrue(array_key_exists('password', $config));
        $this->assertTrue(array_key_exists('endpoint', $config));
        $this->assertTrue(array_key_exists('signature', $config));
    }
}