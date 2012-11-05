<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request;
use SpeckPaypal\Element\Address;
use SpeckPaypal\Element\Config;
use SpeckPaypal\Request\GetBalance;
use Zend\Http\Client\Adapter\Test;

class GetBalanceTest extends PHPUnit_Framework_TestCase
{
    protected $balance;

    public function testMutators()
    {
        $balance = new GetBalance();
        $balance->setReturnAllCurrencies(1);

        $this->assertEquals($balance->getReturnAllCurrencies(), 1);
    }

    public function testToArray()
    {
        $balance = new GetBalance();
        $data = $balance->toArray();

        $this->assertEquals($data['METHOD'], 'GetBalance');
        $this->assertEquals($data['RETURNALLCURRENCIES'], 0);
    }

    public function testIsValid()
    {
        $balance = new GetBalance();
        $this->assertTrue($balance->isValid());
    }

    /**
     * Integration Test - uncomment to test against paypal sandbox api
     *
    public function testIntegration()
    {
        $sm = Bootstrap::getServiceManager();
        $config = $sm->get('application')->getConfig();
        $paypal = new Request;
        $client = new \Zend\Http\Client;
        $client->setMethod('POST');
        $paypal->setClient($client);
        $paypal->setConfig(new Config($config['api']));

        $balance = new GetBalance;

        $response = $paypal->send($balance);
        var_dump($paypal->getClient()->getLastRawResponse());
        var_dump($response);
    }
     */
}