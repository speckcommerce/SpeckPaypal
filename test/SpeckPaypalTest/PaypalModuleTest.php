<?php
namespace SpeckPaypalTest;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use Zend\Db\Adapter\Adapter;
use ZfcBase\Db\Adapter\MasterSlaveAdapter;
use ZfcBaseTest\Mapper\TestAsset\TestMapper;

class PaypalModuleTest extends PHPUnit_Framework_TestCase
{
    public function testCanGetValidPaypalRequestFromSM()
    {
        $sm = Bootstrap::getServiceManager();
        $config = $sm->get('application')->getConfig();
        $this->assertTrue(isset($config['api']));

        $config = $config['api'];
        $this->assertTrue(array_key_exists('username', $config));
        $this->assertTrue(array_key_exists('password', $config));
        $this->assertTrue(array_key_exists('endpoint', $config));
        $this->assertTrue(array_key_exists('signature', $config));
    }
}