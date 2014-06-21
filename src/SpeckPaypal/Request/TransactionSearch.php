<?php
namespace SpeckPaypal\Request;

use SpeckPaypal\Request\AbstractRequest;

class TransactionSearch extends AbstractRequest
{
    /**
     * Start date valid format: 2013-08-24T05:38:48Z
     * @var string
     */
    protected $startDate;

    protected $endDate;

    protected $email;

    protected $receiver;

    protected $receiptId;

    protected $transactionId;

    protected $invNum;

    protected $acct;

    protected $auctionItemNumber;

    protected $transactionClass;

    protected $amt;

    protected $currencyCode;

    protected $status;

    protected $profileId;

    protected $salutation;

    protected $firstName;

    protected $middleName;

    protected $lastName;

    protected $suffix;

    public function __construct($options = array())
    {
        parent::__construct($options);

        $this->setMethod('TransactionSearch');
    }
    
    /**
     * (Required) The earliest transaction date at which to start the search.
     * 
     * Character length and limitations: Must be a valid date, in UTC/GMT format; 
     * for example, 2013-08-24T05:38:48Z. No wildcards are allowed.
     * 
     * @param string $value valid date in UTC/GMT format
     */
    public function setStartDate($value) {
        $this->startDate = $value;
        return $this;
    }

    /**
     * Return the start date
     * 
     * @return string date in UTC/GMT format
     */
    public function getStartDate() {
        return $this->startDate;
    }


    /**
     * get end date
     * 
     * @return string date
     */
    public function getEndDate() {
        return $this->endDate;
    }

    /**
     * (Optional) The latest transaction date to be included in the search.
     *
     * Character length and limitations: Must be a valid date, in UTC/GMT format; 
     * for example, 2013-08-24T05:38:48Z. No wildcards are allowed.
     *
     * @return $this
     */
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    
        return $this;
    }

    /**
     * [description here]
     *
     * @return string email
     */
    public function getEmail() {
        return $this->email;
    }
    
    /**
     * (Optional) Search by the buyer's email address.
     * 
     * Character length and limitations: 127 single-byte alphanumeric characters
     * 
     * @param String $newemail Email
     */
    public function setEmail($email) {
        $this->email = $email;
    
        return $this;
    }


    /**
     * [description here]
     *
     * @return string
     */
    public function getReceiver() {
        return $this->receiver;
    }
    
    /**
     * (Optional) Search by the receiver's email address. If the merchant account has 
     * only one email address, this is the primary email. It can also be a non-primary 
     * email address.
     *
     * @param String $newreceiver 
     */
    public function setReceiver($receiver) {
        $this->receiver = $receiver;
    
        return $this;
    }


    /**
     * [description here]
     *
     * @return string 
     */
    public function getReceiptId() {
        return $this->receiptId;
    }
    
    /**
     * (Optional) Search by the receiver's email address. If the merchant account has only 
     * one email address, this is the primary email. It can also be a non-primary email 
     * address.
     *
     * @param String $newreceiptId 
     */
    public function setReceiptId($receiptId) {
        $this->receiptId = $receiptId;
    
        return $this;
    }


    /**
     * [description here]
     *
     * @return string 
     */
    public function getTransactionId() {
        return $this->transactionId;
    }
    
    /**
     * (Optional) Search by the transaction ID. The returned results are from the merchant's 
     * transaction records.
     *
     * Character length and limitations: 19 single-byte characters maximum
     * 
     * @param String $newtransactionId 
     */
    public function setTransactionId($transactionId) {
        $this->transactionId = $transactionId;
    
        return $this;
    }


    /**
     * [description here]
     *
     * @return string 
     */
    public function getInvNum() {
        return $this->invNum;
    }
    
    /**
     * (Optional) Search by invoice identification key, as set by you for the original 
     * transaction. This field searches the records for items the merchant sells.
     *
     * @param String $newinvNum 
     */
    public function setInvNum($invNum) {
        $this->invNum = $invNum;
    
        return $this;
    }


    /**
     * [description here]
     *
     * @return string 
     */
    public function getAcct() {
        return $this->acct;
    }
    
    /**
     * (Optional) Search by credit card number, as set by you for the original transaction. 
     * This field searches the records for items the merchant sells. The field is not 
     * applicable to point-of-sale.
     *
     * Note No wildcards are allowed.
     *
     * Character length and limitations: Must be at least 11 and no more than 25 single-byte 
     * numeric characters maximum. Special punctuation, such as dashes or spaces, is ignored. 
     * 
     * @param String $newacct 
     */
    public function setAcct($acct) {
        $this->acct = $acct;
    
        return $this;
    }


    /**
     * [description here]
     *
     * @return string 
     */
    public function getAuctionItemNumber() {
        return $this->auctionItemNumber;
    }
    
    /**
     * (Optional) Search by auction item number of the purchased goods. This field is not 
     * applicable to point-of-sale.
     *
     * @param String $newauctionItemNumber 
     */
    public function setAuctionItemNumber($auctionItemNumber) {
        $this->auctionItemNumber = $auctionItemNumber;
    
        return $this;
    }

   
   /**
    * [description here]
    *
    * @return string 
    */
   public function getTransactionClass() {
       return $this->transactionClass;
   }
   
   /**
    * (Optional) Search by classification of transaction. Some kinds of possible classes of 
    * transactions are not searchable with this field. You cannot search for bank transfer 
    * withdrawals, for example. It is one of the following values:
    *
    * All – All transaction classifications
    * Sent – Only payments sent
    * Received – Only payments received
    * MassPay – Only mass payments
    * MoneyRequest – Only money requests
    * FundsAdded – Only funds added to balance
    * FundsWithdrawn – Only funds withdrawn from balance
    * Referral – Only transactions involving referrals
    * Fee – Only transactions involving fees
    * Subscription – Only transactions involving subscriptions
    * Dividend – Only transactions involving dividends
    * Billpay – Only transactions involving BillPay Transactions
    * Refund – Only transactions involving funds
    * CurrencyConversions – Only transactions involving currency conversions
    * BalanceTransfer – Only transactions involving balance transfers
    * Reversal – Only transactions involving BillPay reversals
    * Shipping – Only transactions involving UPS shipping fees
    * BalanceAffecting – Only transactions that affect the account balance
    * ECheck – Only transactions involving eCheck
    * 
    * @param String $newtransactionClass 
    */
   public function setTransactionClass($transactionClass) {
       $this->transactionClass = $transactionClass;
   
       return $this;
   }
   

   /**
    * [description here]
    *
    * @return string 
    */
   public function getAmt() {
       return $this->amt;
   }
   
   /**
    * (Optional) Search by transaction amount.
    *
    * Note You must set the currencyID attribute to one of the 3-character currency 
    * codes for any of the supported PayPal currencies.
    *
    * Character length and limitations: Value is typically a positive number which 
    * cannot exceed 10,000.00 USD or the per transaction limit for the currency. It
    * includes no currency symbol. Most currencies require 2 decimal places, the decimal 
    * separator must be a period (.), and the optional thousands separator must be a comma 
    * (,). Some currencies do not allow decimals. See the currency codes page for details.
    * 
    * @param String $newamt 
    */
   public function setAmt($amt) {
       $this->amt = $amt;
   
       return $this;
   }


   /**
    * [description here]
    *
    * @return string 
    */
   public function getCurrencyCode() {
       return $this->currencyCode;
   }
   
   /**
    * (Optional) Search by 3-character, ISO 4217 currency code.
    *
    * @param String $newcurrencyCode 
    */
   public function setCurrencyCode($currencyCode) {
       $this->currencyCode = $currencyCode;
   
       return $this;
   }


   /**
    * [description here]
    *
    * @return string 
    */
   public function getStatus() {
       return $this->status;
   }
   
   /**
    * (Optional) Search by transaction status. It is one of the following values:
    * 
    * Pending – The payment is pending. The specific reason the payment is pending 
    * is returned by the GetTransactionDetails API PendingReason field.
    * Processing – The payment is being processed.
    * Success – The payment has been completed and the funds have been added 
    * successfully to your account balance.
    * Denied – You denied the payment. This happens only if the payment was previously 
    * pending.
    * Reversed – A payment was reversed due to a chargeback or other type of reversal. 
    * The funds have been removed from your account balance and returned to the buyer.
    *
    * @param String $newstatus 
    */
   public function setStatus($status) {
       $this->status = $status;
   
       return $this;
   }


   /**
    * [description here]
    *
    * @return string 
    */
   public function getProfileId() {
       return $this->profileId;
   }
   
   /**
    * (Optional) An alphanumeric string (generated by PayPal) that uniquely identifies a 
    * recurring profile. You can specify the Profile ID in the TransactionSearch API operation 
    * to obtain all payments associated with the identified profile.
    *
    * @param String $newprofileId 
    */
   public function setProfileId($profileId) {
       $this->profileId = $profileId;
   
       return $this;
   }


   /* PAYER INFORMATION */

   /**
    * [description here]
    *
    * @return string 
    */
   public function getSalutation() {
       return $this->salutation;
   }
   
   /**
    * (Optional) Buyer's salutation.
    *
    * Character length and limitations: 20 single-byte characters
    *
    * @param String $newsalutation 
    */
   public function setSalutation($salutation) {
       $this->salutation = $salutation;
   
       return $this;
   }


   /**
    * [description here]
    *
    * @return string 
    */
   public function getFirstName() {
       return $this->firstName;
   }
   
   /**
    * (Optional) Buyer's first name.
    *
    * Character length and limitations: 25 single-byte characters
    *
    *
    * @param String $newfirstName 
    */
   public function setFirstName($firstName) {
       $this->firstName = $firstName;
   
       return $this;
   }


   /**
    * [description here]
    *
    * @return string 
    */
   public function getMiddleName() {
       return $this->middleName;
   }
   
   /**
    * (Optional) Buyer's middle name.
    *
    * Character length and limitations: 25 single-byte characters
    *
    *
    * @param String $newmiddleName 
    */
   public function setMiddleName($middleName) {
       $this->middleName = $middleName;
   
       return $this;
   }


   /**
    * [description here]
    *
    * @return string 
    */
   public function getLastName() {
       return $this->lastName;
   }
   
   /**
    * (Optional) Buyer's last name.
    *
    * Character length and limitations: 25 single-byte characters
    *
    * @param String $newlastName 
    */
   public function setLastName($lastName) {
       $this->lastName = $lastName;
   
       return $this;
   }


   /**
    * [description here]
    *
    * @return string 
    */
   public function getSuffix() {
       return $this->suffix;
   }
   
   /**
    * (Optional) Buyer's suffix.
    *
    * Character length and limitations: 12 single-byte characters
    *
    * @param String $newsuffix 
    */
   public function setSuffix($suffix) {
       $this->suffix = $suffix;
   
       return $this;
   }

   //  protected $suffix;
    
    public function isValid()
    {
        $startDate = $this->getStartDate();
        if(empty($startDate)) {
            return false;
        }

        return true;
    }
}
