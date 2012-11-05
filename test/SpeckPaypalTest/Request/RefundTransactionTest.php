<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\RefundTransaction;


class RefundTransactionTest extends PHPUnit_Framework_TestCase
{
    protected $refund;

    public function setup()
    {
        $refund = new RefundTransaction();
        $refund->setTransactionId('123456');
        $refund->setPayerId('1234');
        $refund->setInvoiceId('12345');
        $refund->setCurrencyCode('USD');
        $refund->setAmt('10.00');
        $refund->setRefundType(RefundTransaction::FULL);
        $refund->setRetryUntil('60');
        $refund->setRefundSource(RefundTransaction::SOURCE_DEFAULT);
        $refund->setRefundItemDetails('some item');
        $refund->setMerchantStoreDetails('some details');
        $refund->setRefundAdvice(true);
        $refund->setMsgSubId('1234');
        $refund->setStoreId('12');
        $refund->setTerminalId('12345');

        $this->refund = $refund;
    }

    public function testMutators()
    {
        $refund = $this->refund;
        $this->assertEquals($refund->getTransactionId(), '123456');
        $this->assertEquals($refund->getPayerId(), '1234');
        $this->assertEquals($refund->getInvoiceId(), '12345');
        $this->assertEquals($refund->getCurrencyCode(), 'USD');
        $this->assertEquals($refund->getAmt(), '10.00');
        $this->assertEquals($refund->getRefundType(), RefundTransaction::FULL);
        $this->assertEquals($refund->getRetryUntil(), '60');
        $this->assertEquals($refund->getRefundSource(), RefundTransaction::SOURCE_DEFAULT);
        $this->assertEquals($refund->getRefundItemDetails(), 'some item');
        $this->assertEquals($refund->getMerchantStoreDetails(), 'some details');
        $this->assertEquals($refund->getRefundAdvice(), 'true');
        $this->assertEquals($refund->getMsgSubId(), '1234');
        $this->assertEquals($refund->getStoreId(), '12');
        $this->assertEquals($refund->getTerminalId(), '12345');
    }

    public function testToArray()
    {
        $data = $this->refund->toArray();
        $this->assertEquals($data['METHOD'], 'RefundTransaction');
        $this->assertEquals($data['TRANSACTIONID'], '123456');
        $this->assertEquals($data['PAYERID'], '1234');
        $this->assertEquals($data['INVOICEID'], '12345');
        $this->assertEquals($data['CURRENCYCODE'], 'USD');
        $this->assertEquals($data['AMT'], '10.00');
        $this->assertEquals($data['REFUNDTYPE'], RefundTransaction::FULL);
        $this->assertEquals($data['RETRYUNTIL'], '60');
        $this->assertEquals($data['REFUNDSOURCE'], RefundTransaction::SOURCE_DEFAULT);
        $this->assertEquals($data['REFUNDITEMDETAILS'], 'some item');
        $this->assertEquals($data['MERCHANTSTOREDETAILS'], 'some details');
        $this->assertEquals($data['REFUNDADVICE'], 'true');
        $this->assertEquals($data['MSGSUBID'], '1234');
        $this->assertEquals($data['STOREID'], '12');
        $this->assertEquals($data['TERMINALID'], '12345');
    }

    public function testIsValid()
    {
        $refund = $this->refund;

        $this->assertTrue($refund->isValid());

        $clone = clone $refund;

        $clone->setPayerId(null);
        $this->assertTrue($clone->isValid());

        $clone->setTransactionId(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $refund;
        $clone->setRefundType(RefundTransaction::PARTIAL);
        $clone->setAmt(null);
        $this->assertFalse($clone->isValid());

    }
}