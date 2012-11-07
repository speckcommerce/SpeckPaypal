<?php
namespace SpeckPaypalTest\Response;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Response\Response;

class ResponseTest extends PHPUnit_Framework_TestCase
{
    public function testNoResponse()
    {
        $response = new Response;
        $this->assertFalse($response->isSuccess());
        $this->assertEquals('ACK key not found in response.', current($response->getErrorMessages()));

        //token value doesn't exist should return null.
        $this->assertNull($response->getToken());
    }

    public function testInvalidReponse()
    {
        $response = new Response("ACK=Failure&L_ERRORCODE0=81002&L_SHORTMESSAGE0="
            . "Unspecified%20Method&L_LONGMESSAGE0=Method%20Specified%20is%20not%20"
            . "Supported&L_SEVERITYCODE0=Error");

        $this->assertFalse($response->isSuccess());
        $this->assertEquals(current($response->getErrorMessages()), 'Method Specified is not Supported');
        $this->assertEquals("ACK=Failure&L_ERRORCODE0=81002&L_SHORTMESSAGE0="
            . "Unspecified%20Method&L_LONGMESSAGE0=Method%20Specified%20is%20not%20"
            . "Supported&L_SEVERITYCODE0=Error", $response->getRawResponse());
    }

    public function testDoCaptureResponse()
    {
        $response = new Response("AUTHORIZATIONID=0G2404985G760651A"
            . "&TIMESTAMP=2012-11-06T02:06:55Z"
            . "&CORRELATIONID=8280ed8577b4a"
            . "&ACK=Success"
            . "&VERSION=58.0"
            . "&BUILD=4181146"
            . "&TRANSACTIONID=809353695E2857501"
            . "&PARENTTRANSACTIONID=0G2404985G760651A"
            . "&RECEIPTID=3468-7990-5804-3429"
            . "&TRANSACTIONTYPE=webaccept"
            . "&PAYMENTTYPE=instant"
            . "&ORDERTIME=2012-11-06T02:06:53Z"
            . "&AMT=0.05"
            . "&FEEAMT=0.05"
            . "&TAXAMT=0.00"
            . "&CURRENCYCODE=USD"
            . "&PAYMENTSTATUS=Completed"
            . "&PENDINGREASON=None"
            . "&REASONCODE=None"
            . "&PROTECTIONELIGIBILITY=Ineligible");

        $this->assertTrue($response->isSuccess());
        $this->assertEquals('809353695E2857501', $response->getTransactionId());
        $this->assertEquals('0G2404985G760651A', $response->getParentTransactionId());
        $this->assertEquals('3468-7990-5804-3429', $response->getReceiptId());
        $this->assertEquals('webaccept', $response->getTransactionType());
        $this->assertEquals('instant', $response->getPaymentType());
        $this->assertEquals('2012-11-06T02:06:53Z', $response->getOrderTime());
        $this->assertEquals('0.05', $response->getAmt());
        $this->assertEquals('0.05', $response->getFeeAmt());
        $this->assertEquals('0.00', $response->getTaxAmt());
        $this->assertEquals('USD', $response->getCurrencyCode());
        $this->assertEquals('Completed', $response->getPaymentStatus());
        $this->assertEquals('None', $response->getPendingReason());
        $this->assertEquals('None', $response->getReasonCode());
        $this->assertEquals('Ineligible', $response->getProtectionEligibility());
    }

    public function testParseNVP()
    {
        $response = new Response("AUTHORIZATIONID=0G2404985G760651A"
            . "&TIMESTAMP=2012-11-06T02:06:55Z"
            . "&CORRELATIONID=8280ed8577b4a"
            . "&ACK=Success"
            . "&VERSION=58.0"
            . "&BUILD=4181146"
            . "&PROTECTIONELIGIBILITY=Ineligible"
            . "&L_NAME0=tonka"
            . "&L_AMT0=0.05"
            . "&L_PAYMENTINFO_0_FMFfilterID0=3"
            . "&L_PAYMENTINFO_0_FMFfilterNAME0=PENDING"
            . "&L_PAYMENTINFO_1_FMFfilterID0=4"
            . "&L_PAYMENTINFO_1_FMFfilterNAME0=PENDING"
            . "&PAYMENTINFO_0_PAYMENTREQUESTID=23"
            . "&PAYMENTREQUEST_0_AMT=0.05"
            . "&PAYMENTREQUEST_0_TRANSACTIONID=809353695E2857501"
            . "&PAYMENTINFO_1_PAYMENTREQUESTID=24"
            . "&PAYMENTREQUEST_1_AMT=0.06"
            . "&PAYMENTREQUEST_1_TRANSACTIONID=809353695E2857502"
            . "&L_PAYMENTREQUEST_1_SOMERANDOM0=randomvar"
        );

        $paymentInfo    = $response->getPaymentInfo();
        $paymentRequest = $response->getPaymentRequest();

        $this->assertEquals(2, count($paymentInfo));
        $this->assertEquals(2, count($paymentRequest));
        $this->assertEquals('Ineligible', $response->getProtectionEligibility());

        $firstPI = current($paymentInfo);
        $firstRP = current($paymentRequest);
        $this->assertTrue(isset($firstPI['FILTERS']) && isset($firstPI['FILTERS'][0]));
        $this->assertEquals('3', $firstPI['FILTERS'][0]['FMFfilterID']);
        $this->assertEquals('23', $firstPI['PAYMENTREQUESTID']);
        $this->assertEquals('0.05', $firstRP['AMT']);

        $secondPI = next($paymentInfo);
        $secondRP = next($paymentRequest);
        $this->assertTrue(isset($secondRP['OTHER']) && isset($secondRP['OTHER'][0]));
        $this->assertEquals('randomvar', $secondRP['OTHER'][0]['SOMERANDOM']);
        $this->assertEquals('24', $secondPI['PAYMENTREQUESTID']);
        $this->assertEquals('0.06', $secondRP['AMT']);

        $items = $response->getItems();
        $this->assertEquals(1, count($items));
        $item = current($items);
        $this->assertEquals('tonka', $item['NAME']);
        $this->assertEquals('0.05', $item['AMT']);
    }

    public function testCallbackResponse()
    {
        $response = new Response(
            "TIMESTAMP=2012%2d11%2d02T06%3a11%3a17Z"
                . "&METHOD=Callback"
                . "&TOKEN=123456789"
                . "&LOCALECODE=en"
                . "&ACK=Success"
                . "&VERSION=95%2e0"
                . "&BUILD=4137385"
                . "&CURRENCYCODE=USD"
                . '&L_NAME0=Blue pill'
                . '&L_NUMBER0=1'
                . '&L_DESC0=take%20it'
                . '&L_AMT0=10%2e00'
                . '&L_QTY0=1'
                . '&L_ITEMWEIGHTVALUE0='
                . '&L_ITEMWEIGHTUNIT0='
                . '&L_ITEMHEIGHTVALUE0='
                . '&L_ITEMHEIGHTUNIT0='
                . '&L_ITEMWIDTHVALUE0='
                . '&L_ITEMWIDTHUNIT0='
                . '&L_ITEMLENGTHVALUE0='
                . '&L_ITEMLENGTHUNIT0='
                . '&SHIPTOSTREET=27%20nowhere'
                . '&SHIPTOSTREET2=apt%201'
                . '&SHIPTOCITY=laguna'
                . '&SHIPTOSTATE=California'
                . '&SHIPTOZIP=92651'
                . '&SHIPTOCOUNTRY=US'
        );

        $items   = $response->getItems();

        $this->assertTrue($response->isSuccess());

        $this->assertEquals('123456789', $response->getToken());
        $this->assertEquals('USD', $response->getCurrencyCode());
        $this->assertEquals('en', $response->getLocaleCode());

        //check address
        $this->assertEquals('27 nowhere', $response->getShipToStreet());
        $this->assertEquals('apt 1', $response->getShipToStreet2());
        $this->assertEquals('laguna', $response->getShipToCity());
        $this->assertEquals('California', $response->getShipToState());
        $this->assertEquals('92651', $response->getShipToZip());
        $this->assertEquals('US', $response->getShipToCountry());

        //check item(s)
        $item = current($items);
        $this->assertEquals('Blue pill', $item['NAME']);
        $this->assertEquals('1', $item['NUMBER']);
        $this->assertEquals('take it', $item['DESC']);
        $this->assertEquals('10.00', $item['AMT']);
        $this->assertEquals('1', $item['QTY']);
    }

    public function testDoDirectPaymentResponse()
    {
        $response = new Response("TIMESTAMP=2012-11-06T02:06:30Z"
                . "&CORRELATIONID=592289c47eba2"
                . "&ACK=Success"
                . "&VERSION=58.0"
                . "&BUILD=4137385"
                . "&AMT=0.05"
                . "&CURRENCYCODE=USD"
                . "&AVSCODE=X"
                . "&CVV2MATCH=M"
                . "&L_FMFfilterID0=1234"
                . "&L_FMFfilterNAME0=filtername"
                . "&TRANSACTIONID=0G2404985G760651A"
        );

        $this->assertTrue($response->isSuccess());
        $this->assertEquals('0G2404985G760651A', $response->getTransactionId());
        $this->assertEquals('M', $response->getCvv2Match());
        $this->assertEquals('X', $response->getAvsCode());
        $this->assertEquals('0.05', $response->getAmt());

        $filters = current($response->getFilters());

        //$this->assertTrue($filters instanceof \SpeckPaypal\Element\FmfFilter);
        $this->assertEquals('1234', $filters['FMFfilterID']);
        $this->assertEquals('filtername', $filters['FMFfilterNAME']);
    }
}