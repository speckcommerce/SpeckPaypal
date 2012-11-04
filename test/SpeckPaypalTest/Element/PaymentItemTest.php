<?php
namespace SpeckPaypalTest\Element;

use SpeckPaypal\Bootstrap;
use PHPUnit_Framework_TestCase;
use SpeckPaypal\Element\PaymentItem;

class PaymentItemTest extends PHPUnit_Framework_TestCase
{

    protected $item;

    public function setup()
    {
        $item = new PaymentItem;
        $item->setName('name');
        $item->setDesc('desc');
        $item->setAmt('10.00');
        $item->setNumber('1234');
        $item->setQty('1');
        $item->setTaxAmt('0.00');
        $item->setItemWeightValue('1.0');
        $item->setItemWeightUnit('lbs');
        $item->setItemLengthValue('1.0');
        $item->setItemLengthUnit('inch');
        $item->setItemWidthValue('1.0');
        $item->setItemWidthUnit('inch');
        $item->setItemHeightValue('1.0');
        $item->setItemHeightUnit('inch');
        $item->setItemUrl('http://anitem.url');
        $item->setItemCategory('Digital');

        $this->item = $item;
    }
    
    public function testMutators()
    {
        $item = $this->item;
        $this->assertEquals($item->getName(),'name');
        $this->assertEquals($item->getDesc(),'desc');
        $this->assertEquals($item->getAmt(),'10.00');
        $this->assertEquals($item->getNumber(),'1234');
        $this->assertEquals($item->getQty(),'1');
        $this->assertEquals($item->getTaxAmt(),'0.00');
        $this->assertEquals($item->getItemWeightValue(),'1.0');
        $this->assertEquals($item->getItemWeightUnit(),'lbs');
        $this->assertEquals($item->getItemLengthValue(),'1.0');
        $this->assertEquals($item->getItemLengthUnit(),'inch');
        $this->assertEquals($item->getItemWidthValue(),'1.0');
        $this->assertEquals($item->getItemWidthUnit(),'inch');
        $this->assertEquals($item->getItemHeightValue(),'1.0');
        $this->assertEquals($item->getItemHeightUnit(),'inch');
        $this->assertEquals($item->getItemUrl(),'http://anitem.url');
        $this->assertEquals($item->getItemCategory(),'Digital');
    }
    
    public function testToArray()
    {
        $item = $this->item;
        $data = $item->toArray();
        $this->assertEquals($data['NAME'],'name');
        $this->assertEquals($data['DESC'],'desc');
        $this->assertEquals($data['AMT'],'10.00');
        $this->assertEquals($data['NUMBER'],'1234');
        $this->assertEquals($data['QTY'],'1');
        $this->assertEquals($data['TAXAMT'],'0.00');
        $this->assertEquals($data['ITEMWEIGHTVALUE'],'1.0');
        $this->assertEquals($data['ITEMWEIGHTUNIT'],'lbs');
        $this->assertEquals($data['ITEMLENGTHVALUE'],'1.0');
        $this->assertEquals($data['ITEMLENGTHUNIT'],'inch');
        $this->assertEquals($data['ITEMWIDTHVALUE'],'1.0');
        $this->assertEquals($data['ITEMWIDTHUNIT'],'inch');
        $this->assertEquals($data['ITEMHEIGHTVALUE'],'1.0');
        $this->assertEquals($data['ITEMHEIGHTUNIT'],'inch');
        $this->assertEquals($data['ITEMURL'],'http://anitem.url');
        $this->assertEquals($data['ITEMCATEGORY'],'Digital');
    }
}