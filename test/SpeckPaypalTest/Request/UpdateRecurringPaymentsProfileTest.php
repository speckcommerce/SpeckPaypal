<?php
namespace SpeckPaypalTest\Request;

use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\UpdateRecurringPaymentsProfile;
use SpeckPaypal\Element\Address;

class UpdateRecurringPaymentsProfileTest extends PHPUnit_Framework_TestCase
{
    protected $profile;

    public function setup()
    {
        $profile = new UpdateRecurringPaymentsProfile(array('profileId' => '123456789'));

        $profile->setNote('note');
        $profile->setDesc('description');
        $profile->setSubscriberName('John Doe');
        $profile->setProfileReference('reference');
        $profile->setAdditionalBillingCycles(2);
        $profile->setAmt(50);
        $profile->setShippingAmt(5);
        $profile->setTaxAmt(0);
        $profile->setOutstandingAmt(150);
        $profile->setAutoBillOutAmt('NoAutoBill');
        $profile->setMaxFailedPayments(3);
        $profile->setProfileStartDate('2013-07-26 12:00:00');
        $profile->setTotalBillingCycles(3);
        $profile->setTrialTotalBillingCycles(2);
        $profile->setTrialAmt(1);
        $profile->setCurrencyCode('GBP');

        $profile->setCreditCardType('Maestro');
        $profile->setCardNumber('4000000000000010');
        $profile->setExpirationDate('082015');
        $profile->setCvv2('123');
        $profile->setStartDate('082010');
        $profile->setIssueNumber('11');

        $profile->setEmail('mail@example.com');
        $profile->setFirstName('John');
        $profile->setLastName('Doe');

        $address = new Address;
        $address->setStreet('my street');
        $address->setState('Kent');
        $address->setCity('Rochester');
        $address->setZip('AA12 3BB');
        $address->setCountry('GB');
        $address->setPhoneNum('01234567890');

        $profile->setAddress($address);
        $profile->setShipAddress(clone $address);

        $this->profile = $profile;
    }

    public function testMutators()
    {
        $profile = $this->profile;

        $this->assertEquals($profile->getNote(), 'note');
        $this->assertEquals($profile->getDesc(), 'description');
        $this->assertEquals($profile->getSubscriberName(), 'John Doe');
        $this->assertEquals($profile->getProfileReference(), 'reference');
        $this->assertEquals($profile->getAdditionalBillingCycles(), '2');
        $this->assertEquals($profile->getAmt(), 50);
        $this->assertEquals($profile->getShippingAmt(), 5);
        $this->assertEquals($profile->getTaxAmt(), 0);
        $this->assertEquals($profile->getOutstandingAmt(), '150');
        $this->assertEquals($profile->getAutoBillOutAmt(), 'NoAutoBill');
        $this->assertEquals($profile->getMaxFailedPayments(), 3);
        $this->assertEquals($profile->getProfileStartDate(), '2013-07-26 12:00:00');
        $this->assertEquals($profile->getTotalBillingCycles(), 3);
        $this->assertEquals($profile->getTrialTotalBillingCycles(), 2);
        $this->assertEquals($profile->getTrialAmt(), 1);
        $this->assertEquals($profile->getCurrencyCode(), 'GBP');

        $this->assertEquals($profile->getCreditCardType(), 'Maestro');
        $this->assertEquals($profile->getAcct(), '4000000000000010');
        $this->assertEquals($profile->getCardNumber(), '4000000000000010');
        $this->assertEquals($profile->getExpDate(), '082015');
        $this->assertEquals($profile->getExpirationDate(), '082015');
        $this->assertEquals($profile->getCvv2(), '123');
        $this->assertEquals($profile->getStartDate(), '082010');
        $this->assertEquals($profile->getIssueNumber(), '11');

        $this->assertEquals($profile->getEmail(), 'mail@example.com');
        $this->assertEquals($profile->getFirstName(), 'John');
        $this->assertEquals($profile->getLastName(), 'Doe');

        $address = $profile->getAddress();
        $this->assertEquals($address->getStreet(), 'my street');
        $this->assertEquals($address->getState(), 'Kent');
        $this->assertEquals($address->getCity(), 'Rochester');
        $this->assertEquals($address->getZip(), 'AA12 3BB');
        $this->assertEquals($address->getCountryCode(), 'GB');
        $this->assertEquals($address->getPhoneNum(), '01234567890');

        $address = $profile->getShipAddress();
        $this->assertEquals($address->getStreet(), 'my street');
        $this->assertEquals($address->getState(), 'Kent');
        $this->assertEquals($address->getCity(), 'Rochester');
        $this->assertEquals($address->getZip(), 'AA12 3BB');
        $this->assertEquals($address->getCountryCode(), 'GB');
        $this->assertEquals($address->getPhoneNum(), '01234567890');
    }

    public function testToArray()
    {
        $profile = $this->profile;
        $data = $profile->toArray();

        $this->assertEquals($data['METHOD'], 'UpdateRecurringPaymentsProfile');
        $this->assertEquals($data['PROFILEID'], '123456789');
        $this->assertEquals($data['NOTE'], 'note');
        $this->assertEquals($data['DESC'], 'description');
        $this->assertEquals($data['SUBSCRIBERNAME'], 'John Doe');
        $this->assertEquals($data['PROFILEREFERENCE'], 'reference');
        $this->assertEquals($data['ADDITIONALBILLINGCYCLES'], 2);
        $this->assertEquals($data['OUTSTANDINGAMT'], 150);
        $this->assertEquals($data['AUTOBILLOUTAMT'], 'NoAutoBill');
        $this->assertEquals($data['MAXFAILEDPAYMENTS'], 3);
        $this->assertEquals($data['PROFILESTARTDATE'], '2013-07-26 12:00:00');
        $this->assertEquals($data['TOTALBILLINGCYCLES'], 3);
        $this->assertEquals($data['AMT'], 50);
        $this->assertEquals($data['TRIALTOTALBILLINGCYCLES'], 2);
        $this->assertEquals($data['TRIALAMT'], 1);
        $this->assertEquals($data['CURRENCYCODE'], 'GBP');
        $this->assertEquals($data['SHIPPINGAMT'], 5);
        $this->assertEquals($data['TAXAMT'], 0);
        $this->assertEquals($data['CREDITCARDTYPE'], 'Maestro');
        $this->assertEquals($data['ACCT'], '4000000000000010');
        $this->assertEquals($data['EXPDATE'], '082015');
        $this->assertEquals($data['CVV2'], '123');
        $this->assertEquals($data['STARTDATE'], '082010');
        $this->assertEquals($data['ISSUENUMBER'], '11');
        $this->assertEquals($data['EMAIL'], 'mail@example.com');
        $this->assertEquals($data['FIRSTNAME'], 'John');
        $this->assertEquals($data['LASTNAME'], 'Doe');

        $this->assertEquals($data['STREET'],'my street');
        $this->assertEquals($data['STATE'],'Kent');
        $this->assertEquals($data['CITY'],'Rochester');
        $this->assertEquals($data['ZIP'],'AA12 3BB');
        $this->assertEquals($data['COUNTRYCODE'],'GB');

        $this->assertEquals($data['SHIPTOSTREET'],'my street');
        $this->assertEquals($data['SHIPTOSTATE'],'Kent');
        $this->assertEquals($data['SHIPTOCITY'],'Rochester');
        $this->assertEquals($data['SHIPTOZIP'],'AA12 3BB');
        $this->assertEquals($data['SHIPTOCOUNTRYCODE'],'GB');
        $this->assertEquals($data['SHIPTOPHONENUM'],'01234567890');
    }

    public function testIsValid()
    {
        $profile = $this->profile;

        $this->assertTrue($profile->isValid());
        
        $profile->setprofileId(null);
        $this->assertFalse($profile->isValid());
    }
}