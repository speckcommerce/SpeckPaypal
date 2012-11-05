<?php
namespace SpeckPaypal\Element;

use SpeckPaypal\Element\AbstractElement;

class PaymentItem extends AbstractElement
{

    protected $name;
    protected $desc;
    protected $amt;
    protected $number;
    protected $qty;
    protected $taxAmt;
    protected $itemWeightValue;
    protected $itemWeightUnit = 'lbs';
    protected $itemLengthValue;
    protected $itemLengthUnit;
    protected $itemWidthValue;
    protected $itemWidthUnit;
    protected $itemHeightValue;
    protected $itemHeightUnit;
    protected $itemUrl;
    protected $itemCategory;

    const CATEGORY_DIGITAL = "Digital";
    const CATEGORY_PHYSICAL = "Physical";

    /**
     * Indicates whether an item is digital or physical. For digital goods, this field is required
     * and must be set to Digital. You can specify up to 10 payments, where n is a digit between 0 and 9,
     * inclusive, and m specifies the list item within the payment; except for digital goods, which only
     * supports single payments. These parameters must be ordered sequentially beginning with 0
     * (for example L_PAYMENTREQUEST_n_ITEMCATEGORY0, L_PAYMENTREQUEST_n_ITEMCATEGORY1).
     *
     * It is one of the following values:
     * Digital
     * Physical
     */
    public function setItemCategory($category)
    {
        if(in_array($category, array(self::CATEGORY_DIGITAL, self::CATEGORY_PHYSICAL))) {
            $this->itemCategory = $category;
        }

        return $this;
    }

    /**
     * (Optional) Cost of item.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_AMT0, L_AMT1).
     *	NOTE: Character length and limitations: Must not exceed $10,000 USD in any
     *	currency. No currency symbol. Regardless of currency, decimal separator
     *	must be a period (.), and the optional thousands separator must be a comma
     *	(,). Equivalent to nine characters maximum for USD.
     *	NOTE: If you specify a value for L_AMTn, you must specify a value for ITEMAMT.
     */
    public function setAmt($amt)
    {
        $this->amt = $amt;
    }

    /**
     * (Optional) Item description. You can specify up to 10 payments, where n is a digit
     * between 0 and 9, inclusive, and m specifies the list item within the payment; except
     * for digital goods, which supports single payments only. These parameters must be ordered
     * sequentially beginning with 0 (for example L_PAYMENTREQUEST_n_DESC0, L_PAYMENTREQUEST_n_DESC1).
     *
     * Character length and limitations: 127 single-byte characters
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /*
     * (Optional) Item height corresponds to the height of the item. You can pass this data to
     *	the shipping carrier as is without having to make an additional database query.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_ITEMHEIGHTVALUE0, L_ITEMHEIGHTVALUE1).
     *	Character length and limitations: Any positive integer
     */
    public function setItemHeightUnit($itemHeightUnit)
    {
        $this->itemHeightUnit = $itemHeightUnit;

        return $this;
    }

    /*
     * (Optional) Item height corresponds to the height of the item. You can pass this data to
     *	the shipping carrier as is without having to make an additional database query.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_ITEMHEIGHTVALUE0, L_ITEMHEIGHTVALUE1).
     *	Character length and limitations: Any positive integer
     */
    public function setItemHeightValue($itemHeightValue)
    {
        $this->itemHeightValue = $itemHeightValue;

        return $this;
    }

    /**
     * (Optional) Item length corresponds to the length of the item. You can pass this data to
     *	the shipping carrier as is without having to make an additional database query.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_ITEMLENGTHVALUE0, L_ITEMLENGTHVALUE1).
     *	Character length and limitations: Any positive integer
     */
    public function setItemLengthUnit($itemLengthUnit)
    {
        $this->itemLengthUnit = $itemLengthUnit;

        return $this;
    }

    /**
     * (Optional) Item length corresponds to the length of the item. You can pass this data to
     *	the shipping carrier as is without having to make an additional database query.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_ITEMLENGTHVALUE0, L_ITEMLENGTHVALUE1).
     *	Character length and limitations: Any positive integer
     */
    public function setItemLengthValue($itemLengthValue)
    {
        $this->itemLengthValue = $itemLengthValue;

        return $this;
    }

    /**
     * (Optional) URL for the item. You can specify up to 10 payments, where n is a digit between
     * 0 and 9, inclusive, and m specifies the list item within the payment. These parameters must
     * be ordered sequentially beginning with 0
     *
     * (for example L_PAYMENTREQUEST_n_ITEMURL0, L_PAYMENTREQUEST_n_ITEMURL1).
     */
    public function setItemUrl($itemUrl)
    {
        $this->itemUrl = $itemUrl;

        return $this;
    }

    /**
     * (Optional) Item weight corresponds to the weight of the item. You can pass this data
     *	to the shipping carrier as is without having to make an additional database query.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_ITEMWEIGHTVALUE0, L_ITEMWEIGHTVALUE1).
     *	Character length and limitations: Any positive integer
     */
    public function setItemWeightUnit($itemWeightUnit)
    {
        $this->itemWeightUnit = $itemWeightUnit;

        return $this;
    }

    /**
     * (Optional) Item weight corresponds to the weight of the item. You can pass this data
     *	to the shipping carrier as is without having to make an additional database query.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_ITEMWEIGHTVALUE0, L_ITEMWEIGHTVALUE1).
     *	Character length and limitations: Any positive integer
     */
    public function setItemWeightValue($itemWeightValue)
    {
        $this->itemWeightValue = $itemWeightValue;

        return $this;
    }

    /**
     * (Optional) Item width corresponds to the width of the item. You can pass this data to
     *	the shipping carrier as is without having to make an additional database query.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_ITEMWIDTHVALUE0, L_ITEMWIDTHVALUE1).
     *	Character length and limitations: Any positive integer
     */
    public function setItemWidthUnit($itemWidthUnit)
    {
        $this->itemWidthUnit = $itemWidthUnit;

        return $this;
    }

    /**
     * (Optional) Item width corresponds to the width of the item. You can pass this data to
     *	the shipping carrier as is without having to make an additional database query.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_ITEMWIDTHVALUE0, L_ITEMWIDTHVALUE1).
     *	Character length and limitations: Any positive integer
     */
    public function setItemWidthValue($itemWidthValue)
    {
        $this->itemWidthValue = $itemWidthValue;

        return $this;
    }

    /**
     * (Optional) Item name.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_NAME0, L_NAME1).
     *	Character length and limitations: 127 single-byte characters
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * (Optional) Item number.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_NUMBER0, L_NUMBER1).
     *	Character length and limitations: 127 single-byte characters
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * (Optional) Item quantity.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_QTY0, L_QTY1).
     *	Character length and limitations: Any positive integer
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * (Optional) Item sales tax.
     *	NOTE: Character length and limitations: Must not exceed $10,000 USD in any
     *	currency. No currency symbol. Regardless of currency, decimal separator
     *	must be a period (.), and the optional thousands separator must be a comma
     *	(,). Equivalent to nine characters maximum for USD.
     *	These parameters must be ordered sequentially beginning with 0 (for example
     *	L_TAXAMT0, L_TAXAMT1).
     */
    public function setTaxAmt($taxAmt)
    {
        $this->taxAmt = $taxAmt;

        return $this;
    }

    public function getAmt()
    {
        return $this->amt;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function getItemCategory()
    {
        return $this->itemCategory;
    }

    public function getItemHeightUnit()
    {
        return $this->itemHeightUnit;
    }

    public function getItemHeightValue()
    {
        return $this->itemHeightValue;
    }

    public function getItemLengthUnit()
    {
        return $this->itemLengthUnit;
    }

    public function getItemLengthValue()
    {
        return $this->itemLengthValue;
    }

    public function getItemUrl()
    {
        return $this->itemUrl;
    }

    public function getItemWeightUnit()
    {
        return $this->itemWeightUnit;
    }

    public function getItemWeightValue()
    {
        return $this->itemWeightValue;
    }

    public function getItemWidthUnit()
    {
        return $this->itemWidthUnit;
    }

    public function getItemWidthValue()
    {
        return $this->itemWidthValue;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getQty()
    {
        return $this->qty;
    }

    public function getTaxAmt()
    {
        return $this->taxAmt;
    }


}