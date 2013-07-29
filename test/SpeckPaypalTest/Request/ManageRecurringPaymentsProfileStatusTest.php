<?php
namespace SpeckPaypalTest\Request;

use PHPUnit_Framework_TestCase;
use SpeckPaypal\Request\ManageRecurringPaymentsProfileStatus;

class ManageRecurringPaymentsProfileStatusTest extends PHPUnit_Framework_TestCase
{
    protected $profile;

    public function setup()
    {
        $profile = new ManageRecurringPaymentsProfileStatus();

        $profile->setProfileId('123456');
        $profile->setAction('Cancel');
        $profile->setNote('Hello world');
        $this->profile = $profile;
    }

    public function testMutators()
    {
        $profile = $this->profile;

        $this->assertEquals($profile->getProfileId(), '123456');
        $this->assertEquals($profile->getAction(), 'Cancel');
        $this->assertEquals($profile->getNote(), 'Hello world');
    }

    public function testToArray()
    {
        $profile = $this->profile;
        $data = $profile->toArray();

        $this->assertEquals($data['METHOD'], 'ManageRecurringPaymentsProfileStatus');
        $this->assertEquals($data['PROFILEID'], '123456');
        $this->assertEquals($data['ACTION'], 'Cancel');
        $this->assertEquals($data['NOTE'], 'Hello world');
    }

    public function testIsValid()
    {
        $profile = $this->profile;

        $this->assertTrue($profile->isValid());

        $profile->setNote(null);
        $this->assertTrue($profile->isValid());

        $profile->setProfileId(null);
        $this->assertFalse($profile->isValid());
    }

    /**
     * @expectedException Exception
     */
    public function testException()
    {
       $profile = $this->profile;
       $profile->setAction(null);
    }
}