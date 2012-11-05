<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Element\Address;
use SpeckPaypal\Element\Config;
use SpeckPaypal\Request\DoCapture;
use Zend\Http\Client\Adapter\Test;

class DoCaptureTest extends PHPUnit_Framework_TestCase
{
    protected $capture;

    public function setup()
    {
        $capture = new DoCapture(array(
            'transactionId' => 'test',
            'amt' => '10.00'
        ));
        $capture->setInvoiceNumber('12345');
        $capture->setNote('Thank you!');
        $capture->setSoftDescriptor('ACME Inc.');
        $capture->setMsgSubId('test');

        $this->capture = $capture;
    }

    public function testMutators()
    {
        $capture = $this->capture;
        $this->assertEquals($capture->getAmt(), '10.00');
        $this->assertEquals($capture->getTransactionId(), 'test');
        $this->assertEquals($capture->getInvoiceNumber(), '12345');
        $this->assertEquals($capture->getNote(), 'Thank you!');
        $this->assertEquals($capture->getSoftDescriptor(), 'ACME Inc.');
        $this->assertEquals($capture->getMsgSubId(), 'test');
    }

    public function testToArray()
    {
        $capture = $this->capture;
        $data = $capture->toArray();

        $this->assertEquals($data['AMT'], '10.00');
        $this->assertEquals($data['AUTHORIZATIONID'], 'test');
        $this->assertEquals($data['INVOICENUMBER'], '12345');
        $this->assertEquals($data['NOTE'], 'Thank you!');
        $this->assertEquals($data['SOFTDESCRIPTOR'], 'ACME Inc.');
        $this->assertEquals($data['MSGSUBID'], 'test');
    }

    public function testIsValid()
    {
        $capture = $this->capture;

        $this->assertTrue($capture->isValid());

        $clone = clone $capture;
        $clone->setTransactionId(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $capture;
        $clone->setAmt(null);
        $this->assertFalse($clone->isValid());

        try {
            $clone = clone $capture;
            $clone->setCompleteType(null);
            $this->fail();
        } catch(\Exception $e) {

        }
    }


    /**
     * For integration test @see DirectPaymentTest::testDirectPaymentAuthorizeAndCaptureIntegration
     */
}