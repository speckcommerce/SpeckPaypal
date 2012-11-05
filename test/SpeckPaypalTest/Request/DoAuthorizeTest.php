<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\DoAuthorize;
use SpeckPaypal\Request;
use SpeckPaypal\Element\Config;
use Zend\Http\Client\Adapter\Test;


class DoAuthorizeTest extends PHPUnit_Framework_TestCase
{
    protected $paypalRequest;

    public function testMutators()
    {
        $authorize = new DoAuthorize(array(
            'transactionId' => '1234567',
            'amt' => '10.00'
        ));
        $authorize->setTransactionEntity('Order');
        $authorize->setMsgSubId('msgsubid');

        $this->assertEquals($authorize->getTransactionId(), '1234567');
        $this->assertEquals($authorize->getTransactionEntity(), 'Order');
        $this->assertEquals($authorize->getCurrencyCode(), 'USD');
        $this->assertEquals($authorize->getMsgSubId(), 'msgsubid');
        $this->assertEquals($authorize->getAmt(), '10.00');
    }

    public function testToArray()
    {
        $authorize = new DoAuthorize(array(
            'transactionId' => '1234567',
            'amt' => '10.00'
        ));
        $authorize->setTransactionEntity('Order');
        $authorize->setMsgSubId('msgsubid');

        $data = $authorize->toArray();
        $this->assertEquals($data['METHOD'], 'doAuthorization');
        $this->assertEquals($data['TRANSACTIONID'], '1234567');
        $this->assertEquals($data['TRANSACTIONENTITY'], 'Order');
        $this->assertEquals($data['CURRENCYCODE'], 'USD');
        $this->assertEquals($data['MSGSUBID'], 'msgsubid');
        $this->assertEquals($data['AMT'], '10.00');
    }

    public function testIsValid()
    {
        $authorize = new DoAuthorize(array(
            'transactionId' => '1234567',
            'amt' => '10.00'
        ));

        $this->assertTrue($authorize->isValid());

        $clone = clone $authorize;
        $clone->setTransactionId(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $authorize;
        $clone->setAmt(null);
        $this->assertFalse($clone->isValid());
    }
}