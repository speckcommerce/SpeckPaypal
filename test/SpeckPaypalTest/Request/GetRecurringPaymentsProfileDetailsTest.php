<?php
namespace SpeckPaypalTest\Request;

use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\GetRecurringPaymentsProfileDetails;

class GetRecurringPaymentsProfileDetailsTest extends PHPUnit_Framework_TestCase
{
    protected $profile;

    public function setup()
    {
        $profile = new GetRecurringPaymentsProfileDetails();

        $profile->setProfileId('123456');
        $this->profile = $profile;
    }

    public function testMutators()
    {
        $profile = $this->profile;

        $this->assertEquals($profile->getProfileId(), '123456');
    }

    public function testToArray()
    {
        $profile = $this->profile;
        $data = $profile->toArray();

        $this->assertEquals($data['METHOD'], 'GetRecurringPaymentsProfileDetails');
        $this->assertEquals($data['PROFILEID'], '123456');
    }

    public function testIsValid()
    {
        $profile = $this->profile;

        $this->assertTrue($profile->isValid());

        $profile->setProfileId(null);
        $this->assertFalse($profile->isValid());
    }
}