<?php
namespace SpeckPaypalTest\Request;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request;
use SpeckPaypal\Element\Address;
use SpeckPaypal\Element\Config;
use SpeckPaypal\Request\TransactionSearch;
use Zend\Http\Client\Adapter\Test;

class TransactionSearchTest extends PHPUnit_Framework_TestCase
{
    protected $paypalRequest;

    public function setUp()
    {
        $this->paypalRequest = Bootstrap::getServiceManager()->get('SpeckPaypal\Service\Request');
    }

    public function testMutators()
    {
        $search = new TransactionSearch();
        $search->setstartDate('2014-06-21T00:00:00Z');
        $search->setendDate('2014-06-22T00:00:00Z');
        $search->setemail('test@test.com');
        $search->setreceiver('test1');
        $search->setreceiptId('test2');
        $search->settransactionId('test3');
        $search->setinvNum('test4');
        $search->setacct('test5');
        $search->setauctionItemNumber('test6');
        $search->settransactionClass('test7');
        $search->setamt('test8');
        $search->setcurrencyCode('test9');
        $search->setstatus('test10');
        $search->setprofileId('test11');
        $search->setsalutation('test12');
        $search->setfirstName('test13');
        $search->setmiddleName('test14');
        $search->setlastName('test15');
        $search->setsuffix('test16');

        $this->assertEquals($search->getstartDate(), '2014-06-21T00:00:00Z');
        $this->assertEquals($search->getendDate(), '2014-06-22T00:00:00Z');
        $this->assertEquals($search->getemail(), 'test@test.com');
        $this->assertEquals($search->getreceiver(), 'test1');
        $this->assertEquals($search->getreceiptId(), 'test2');
        $this->assertEquals($search->gettransactionId(), 'test3');
        $this->assertEquals($search->getinvNum(), 'test4');
        $this->assertEquals($search->getacct(), 'test5');
        $this->assertEquals($search->getauctionItemNumber(), 'test6');
        $this->assertEquals($search->gettransactionClass(), 'test7');
        $this->assertEquals($search->getamt(), 'test8');
        $this->assertEquals($search->getcurrencyCode(), 'test9');
        $this->assertEquals($search->getstatus(), 'test10');
        $this->assertEquals($search->getprofileId(), 'test11');
        $this->assertEquals($search->getsalutation(), 'test12');
        $this->assertEquals($search->getfirstName(), 'test13');
        $this->assertEquals($search->getmiddleName(), 'test14');
        $this->assertEquals($search->getlastName(), 'test15');
        $this->assertEquals($search->getsuffix(), 'test16');  
        $this->assertEquals($search->getMethod(), 'TransactionSearch');

    }

    public function testCanGetData()
    {
        $search = new TransactionSearch();
        $search->setstartDate('2014-06-21T00:00:00Z');
        $search->setendDate('2014-06-22T00:00:00Z');
        $search->setemail('test@test.com');
        $search->setreceiver('test1');
        $search->setreceiptId('test2');
        $search->settransactionId('test3');
        $search->setinvNum('test4');
        $search->setacct('test5');
        $search->setauctionItemNumber('test6');
        $search->settransactionClass('test7');
        $search->setamt('test8');
        $search->setcurrencyCode('test9');
        $search->setstatus('test10');
        $search->setprofileId('test11');
        $search->setsalutation('test12');
        $search->setfirstName('test13');
        $search->setmiddleName('test14');
        $search->setlastName('test15');
        $search->setsuffix('test16');

        $data = $search->toArray();
        $this->assertEquals($data['STARTDATE'], '2014-06-21T00:00:00Z');
        $this->assertEquals($data['ENDDATE'], '2014-06-22T00:00:00Z');
        $this->assertEquals($data['EMAIL'], 'test@test.com');
        $this->assertEquals($data['RECEIVER'], 'test1');
        $this->assertEquals($data['RECEIPTID'], 'test2');
        $this->assertEquals($data['TRANSACTIONID'], 'test3');
        $this->assertEquals($data['INVNUM'], 'test4');
        $this->assertEquals($data['ACCT'], 'test5');
        $this->assertEquals($data['AUCTIONITEMNUMBER'], 'test6');
        $this->assertEquals($data['TRANSACTIONCLASS'], 'test7');
        $this->assertEquals($data['AMT'], 'test8');
        $this->assertEquals($data['CURRENCYCODE'], 'test9');
        $this->assertEquals($data['STATUS'], 'test10');
        $this->assertEquals($data['PROFILEID'], 'test11');
        $this->assertEquals($data['SALUTATION'], 'test12');
        $this->assertEquals($data['FIRSTNAME'], 'test13');
        $this->assertEquals($data['MIDDLENAME'], 'test14');
        $this->assertEquals($data['LASTNAME'], 'test15');
        $this->assertEquals($data['SUFFIX'], 'test16');  
        $this->assertEquals($data['METHOD'], 'TransactionSearch');
    }

    public function testTransactionSearchIsValid()
    {
        $search = new TransactionSearch();
        $this->assertFalse($search->isValid());
        $search->setStartDate('2014-06-21T00:00:00Z');
        $this->assertTrue($search->isValid());
    }

    /**
     * Integration Test - uncomment to test against paypal sandbox api
     * @group integration
     
    public function testIntegration()
    {
        $search = new TransactionSearch;
        $search->setStartDate('2014-06-21T00:00:00Z');
        $search->setTransactionId('7KJ28130AS203392S');

        $paypal = $this->paypalRequest;
        $response = $paypal->send($search);
        var_dump($response->getResults());
        $this->assertTrue($response->isSuccess());
       var_dump($paypal->getClient()->getLastRawRequest());
       var_dump($paypal->getClient()->getLastRawResponse());

    }
    */
}