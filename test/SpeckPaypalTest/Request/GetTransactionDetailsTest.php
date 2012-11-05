<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\GetTransactionDetails;


class GetTransactionDetailsTest extends PHPUnit_Framework_TestCase
{
    public function testMutators()
    {
        $details = new GetTransactionDetails(array('transactionId' => '123456'));

        $this->assertEquals($details->getTransactionId(), '123456');
    }

    public function testToArray()
    {
        $details = new GetTransactionDetails(array('transactionId' => '123456'));
        $data = $details->toArray();
        $this->assertEquals($data['METHOD'], 'getTransactionDetails');
        $this->assertEquals($data['TRANSACTIONID'], '123456');
    }

    public function testIsValid()
    {
        $details = new GetTransactionDetails(array('transactionId' => '123456'));
        $this->assertTrue($details->isValid());

        $clone = clone $details;
        $clone->setTransactionId(null);
        $this->assertFalse($clone->isValid());
    }
}