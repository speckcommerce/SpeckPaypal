<?php
namespace SpeckPaypalTest\Request;

use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\CreateRecurringPaymentsProfile;
use SpeckPaypal\Element\Address;

class CreateRecurringPaymentsProfileTest extends PHPUnit_Framework_TestCase
{
    protected $profile;

    public function setup()
    {
        $profile = new CreateRecurringPaymentsProfile();

        $profile->setToken('token');
        $profile->setDesc('description');
        $profile->setMaxFailedPayments(3);
        $profile->setAutoBillOutAmt('NoAutoBill');
        $profile->setSubscriberName('John Doe');
        $profile->setProfileStartDate('2013-07-26 12:00:00');
        $profile->setProfileReference('reference');
        $profile->setBillingPeriod('Month');
        $profile->setBillingFrequency(1);
        $profile->setTotalBillingCycles(3);
        $profile->setAmt(55);
        $profile->setTrialBillingPeriod('Week');
        $profile->setTrialBillingFrequency(1);
        $profile->setTrialTotalBillingCycles(2);
        $profile->setTrialAmt(1);
        $profile->setCurrencyCode('GBP');
        $profile->setShippingAmt(10);
        $profile->setTaxAmt(0);
        $profile->setInitAmt(1);
        $profile->setFailedInitAmtAction('CancelOnFailure');
        $profile->setCreditCardType('Maestro');
        $profile->setCardNumber('4000000000000010');
        $profile->setExpirationDate('082015');
        $profile->setCvv2('123');
        $profile->setStartDate('082010');
        $profile->setIssueNumber('11');
        $profile->setEmail('mail@example.com');
        $profile->setPayerId('123456789');
        $profile->setPayerStatus('unverified');
        $profile->setCountryCode('GB');
        $profile->setBusiness('Super Ltd');
        $profile->setSalutation('Sir');
        $profile->setFirstName('John');
        $profile->setMiddleName('A');
        $profile->setLastName('Doe');
        $profile->setSuffix('Ph.D.');

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

        $this->assertEquals($profile->getToken(), 'token');
        $this->assertEquals($profile->getDesc(), 'description');
        $this->assertEquals($profile->getMaxFailedPayments(), 3);
        $this->assertEquals($profile->getAutoBillOutAmt(), 'NoAutoBill');
        $this->assertEquals($profile->getSubscriberName(), 'John Doe');
        $this->assertEquals($profile->getProfileStartDate(), '2013-07-26 12:00:00');
        $this->assertEquals($profile->getProfileReference(), 'reference');
        $this->assertEquals($profile->getBillingPeriod(), 'Month');
        $this->assertEquals($profile->getBillingFrequency(), 1);
        $this->assertEquals($profile->getTotalBillingCycles(), 3);
        $this->assertEquals($profile->getAmt(), 55);
        $this->assertEquals($profile->getTrialBillingPeriod(), 'Week');
        $this->assertEquals($profile->getTrialBillingFrequency(), 1);
        $this->assertEquals($profile->getTrialTotalBillingCycles(), 2);
        $this->assertEquals($profile->getTrialAmt(), 1);
        $this->assertEquals($profile->getCurrencyCode(), 'GBP');
        $this->assertEquals($profile->getShippingAmt(), 10);
        $this->assertEquals($profile->getTaxAmt(), 0);
        $this->assertEquals($profile->getInitAmt(), 1);
        $this->assertEquals($profile->getFailedInitAmtAction(), 'CancelOnFailure');
        $this->assertEquals($profile->getCreditCardType(), 'Maestro');
        $this->assertEquals($profile->getCardNumber(), '4000000000000010');
        $this->assertEquals($profile->getExpirationDate(), '082015');
        $this->assertEquals($profile->getCvv2(), '123');
        $this->assertEquals($profile->getStartDate(), '082010');
        $this->assertEquals($profile->getIssueNumber(), '11');
        $this->assertEquals($profile->getEmail(), 'mail@example.com');
        $this->assertEquals($profile->getPayerId(), '123456789');
        $this->assertEquals($profile->getPayerStatus(), 'unverified');
        $this->assertEquals($profile->getCountryCode(), 'GB');
        $this->assertEquals($profile->getBusiness(), 'Super Ltd');
        $this->assertEquals($profile->getSalutation(), 'Sir');
        $this->assertEquals($profile->getFirstName(), 'John');
        $this->assertEquals($profile->getMiddleName(), 'A');
        $this->assertEquals($profile->getLastName(), 'Doe');
        $this->assertEquals($profile->getSuffix(), 'Ph.D.');

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

        $this->assertEquals($data['TOKEN'], 'token');
        $this->assertEquals($data['DESC'], 'description');
        $this->assertEquals($data['MAXFAILEDPAYMENTS'], 3);
        $this->assertEquals($data['AUTOBILLOUTAMT'], 'NoAutoBill');
        $this->assertEquals($data['SUBSCRIBERNAME'], 'John Doe');
        $this->assertEquals($data['PROFILESTARTDATE'], '2013-07-26 12:00:00');
        $this->assertEquals($data['PROFILEREFERENCE'], 'reference');
        $this->assertEquals($data['BILLINGPERIOD'], 'Month');
        $this->assertEquals($data['BILLINGFREQUENCY'], 1);
        $this->assertEquals($data['TOTALBILLINGCYCLES'], 3);
        $this->assertEquals($data['AMT'], 55);
        $this->assertEquals($data['TRIALBILLINGPERIOD'], 'Week');
        $this->assertEquals($data['TRIALBILLINGFREQUENCY'], 1);
        $this->assertEquals($data['TRIALTOTALBILLINGCYCLES'], 2);
        $this->assertEquals($data['TRIALAMT'], 1);
        $this->assertEquals($data['CURRENCYCODE'], 'GBP');
        $this->assertEquals($data['SHIPPINGAMT'], 10);
        $this->assertEquals($data['TAXAMT'], 0);
        $this->assertEquals($data['INITAMT'], 1);
        $this->assertEquals($data['FAILEDINITAMTACTION'], 'CancelOnFailure');
        $this->assertEquals($data['CREDITCARDTYPE'], 'Maestro');
        $this->assertEquals($data['ACCT'], '4000000000000010');
        $this->assertEquals($data['EXPDATE'], '082015');
        $this->assertEquals($data['CVV2'], '123');
        $this->assertEquals($data['STARTDATE'], '082010');
        $this->assertEquals($data['ISSUENUMBER'], '11');
        $this->assertEquals($data['EMAIL'], 'mail@example.com');
        $this->assertEquals($data['PAYERID'], '123456789');
        $this->assertEquals($data['PAYERSTATUS'], 'unverified');
        $this->assertEquals($data['COUNTRYCODE'], 'GB');
        $this->assertEquals($data['BUSINESS'], 'Super Ltd');
        $this->assertEquals($data['SALUTATION'], 'Sir');
        $this->assertEquals($data['FIRSTNAME'], 'John');
        $this->assertEquals($data['MIDDLENAME'], 'A');
        $this->assertEquals($data['LASTNAME'], 'Doe');
        $this->assertEquals($data['SUFFIX'], 'Ph.D.');
        $this->assertEquals($data['METHOD'], 'CreateRecurringPaymentsProfile');

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

        $clone = clone $profile;
        $clone->setProfileStartDate(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $profile;
        $clone->setDesc(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $profile;
        $clone->setBillingFrequency(null);
        $this->assertFalse($clone->isValid());
        
        $clone = clone $profile;
        $clone->setAmt(null);
        $this->assertFalse($clone->isValid());
        
        $clone = clone $profile;
        $clone->setCurrencyCode(null);
        $this->assertFalse($clone->isValid());
        
        $clone = clone $profile;
        $clone->setCardNumber(null);
        $this->assertFalse($clone->isValid());
        
        $clone = clone $profile;
        $clone->setEmail(null);
        $this->assertFalse($clone->isValid());

        $clone = clone $profile;
        $clone->setAddress(null);
        $this->assertFalse($clone->isValid());
    }
}