<?php
namespace SpeckPaypal;

class Response
{
    protected $commsMessage  = array(
        -1 => 'Failed to connect to host',
        -2 => 'Failed to resolve hostname',
        -5 => 'Failed to initialize SSL context',
        -6 => 'Parameter list format error: & in name',
        -7 => 'Parameter list format error: invalid [ ] name length clause',
        -8 => 'SSL failed to connect to host',
        -9 => 'SSL read failed',
        -10 => 'SSL write failed',
        -11 => 'Proxy authorization failed',
        -12 => 'Timeout waiting for response',
        -13 => 'Select failure',
        -14 => 'Too many connections',
        -15 => 'Failed to set socket options',
        -20 => 'Proxy read failed',
        -21 => 'Proxy write failed',
        -22 => 'Failed to initialize SSL certificate',
        -23 => 'Host address not specified',
        -24 => 'Invalid transaction type',
        -25 => 'Failed to create a socket',
        -26 => 'Failed to initialize socket layer',
        -27 => 'Parameter list format error: invalid [ ] name length clause',
        -28 => 'Parameter list format error: name',
        -29 => 'Failed to initialize SSL connection',
        -30 => 'Invalid timeout value',
        -31 => 'The certificate chain did not validate, no local certificate found',
        -32 => 'The certificate chain did not validate, common name did not match URL',
        -40 => 'Unexpected Request ID found in request.',
        -41 => 'Required Request ID not found in request',
        -99 => 'Out of memory',
        -100 => 'Parameter list cannot be empty',
        -103 => 'Context initialization failed',
        -104 => 'Unexpected transaction state',
        -105 => 'Invalid name value pair request',
        -106 => 'Invalid response format',
        -107 => 'This XMLPay version is not supported',
        -108 => 'The server certificate chain did not validate',
        -109 => 'Unable to do logging',
        -111 => 'The following error occurred while initializing from message file: <Details of the error message>',
        -113 => 'Unable to round and truncate the currency value simultaneously',
    );

    protected $resultMessage = array(
        0 => 'Approved',
        1 => 'User Authentication Failed',
        2 => 'Invalid Tender Type',
        3 => 'Invalid Transaction Type',
        4 => 'Invalid Amount',
        5 => 'Invalid Merchant Information',
        6 => 'Invalid Currency Code',
        7 => 'Field Format Error',
        8 => 'Not a transaction server',
        9 => 'Too many paramenters or invlaid stream',
        10 => 'Too many line items',
        11 => 'Client Time-out waiting for response',
        12 => 'Declined',
        13 => 'Referral',
        19 => 'Original transaction ID not found',
        20 => 'Cannot find the customer reference number',
        22 => 'Invalid ABA number',
        23 => 'Invalid account number',
        24 => 'Invalid expiration date',
        25 => 'Invalid host mapping',
        26 => 'Invalid vendor account',
        27 => 'Insufficient partner permissions',
        28 => 'Insufficient user permissions',
        29 => 'Invalid XML document',
        30 => 'Duplicate transaction',
        31 => 'Error in adding the recurring profile',
        32 => 'Error in modifying the recurring profile',
        33 => 'Error in canceling the recurring profile',
        34 => 'Error in forcing the recurring profile',
        35 => 'Error in reactivation the recurring profile',
        36 => 'OLTP Transaction Failed',
        37 => 'Invalid recurring profile ID',
        50 => 'Insufficient funds available in account',
        51 => 'Exceeds per transaction limit',
        99 => 'General Error',
        100 => 'Transaction type not supported by host',
        101 => 'Time-out value too small',
        102 => 'Processor not available',
        103 => 'Error reading response from host',
        104 => 'Timeout waiting for processor response',
        105 => 'Credit Error',
        106 => 'Host not available',
        107 => 'Duplicate suppression time-out',
        108 => 'Void error',
        109 => 'Time-out waiting for response',
        110 => 'Referenced auth (against order) error',
        111 => 'Capture error',
        112 => 'Failed AVS Check',
        113 => 'Marchant sale total will exceed the sales cap with current transaction',
        114 => 'Card security code (CSC) mismatch',
        115 => 'System busy, try again later',
        116 => 'Paypal internal error.  Failed to lock terminal number',
        117 => 'Failed merchant rule check',
        118 => 'Invalid keywords found in string fields',
        120 => 'Attempt to reference a failed transaction',
        121 => 'Not enabled for feature',
        122 => 'Merchant sale total will exceed the credit cap with current transaction.',
        125 => 'Fraud Protected Services Filter - Declined by Filters',
        126 => 'Fraud Protection Services Filter - Flagged for review by filters',
        127 => 'Fraud Protection Services Filter - Not processed by filters',
        128 => 'Fraud Protection Services Filter - Declined by merchant after being flagged for review by filters',
        132 => 'Card has not been submitted for update',
        133 => 'Data mismatch in HTTP retry request',
        150 => 'Issueing bank timed out',
        151 => 'Issueing bank unavailable',
        200 => 'Reauth error',
        201 => 'Order Error',
        600 => 'Cybercash Batch error',
        601 => 'Cybercash Query Error',
        1000 => 'Generic Host Error',
        1001 => 'Buyer Authentication Service unavailable',
        1002 => 'Buyer Authentication Service transaction timeout',
        1003 => 'Buyer Authentication Service invalid client version',
        1004 => 'Buyer Authentication Service invalid timeout value',
        1011 => 'Buyer AUthentication Service unavailable',
        1012 => 'Buyer AUthentication Service unavailable',
        1013 => 'Buyer AUthentication Service unavailable',
        1014 => 'Buyer AUthentication Service - Merchant is not enrolled for Buyer Authentication Service (3-D Secure)',
        1016 => 'Buyer AUthentication Service - 3 D Secure error response received.',
        1017 => 'Buyer AUthentication Service - 3 D Secure response is invalid',
        1021 => 'Buyer AUthentication Service - invalid card type',
        1022 => 'Buyer AUthentication Service - Invalid or missing currency code',
        1023 => 'Buyer AUthentication Service - merchant status for 3D secure is invalid',
        1041 => 'Buyer Authentication Service ó Validate Authentication failed: missing or invalid PARES',
        1042 => 'Buyer Authentication Service ó Validate Authentication failed: PARES format is invalid',
        1043 => 'Buyer Authentication Service ó Validate Authentication failed: Cannot find successful Verify Enrollment',
        1044 => 'Buyer Authentication Service ó Validate Authentication failed: Signature validation failed for PARES',
        1045 => 'Buyer Authentication Service ó Validate Authentication failed: Mismatched or invalid amount in PARES',
        1046 => 'Buyer Authentication Service ó Validate Authentication failed: Mismatched or invalid aquirer in PARES',
        1047 => 'Buyer Authentication Service ó Validate Authentication failed: Mismatched or invlaid Merchant ID in PARES',
        1048 => 'Buyer Authentication Service ó Validate Authentication failed: Mismatched or invlaid card number in PARES',
        1049 => 'Buyer Authentication Service ó Validate Authentication failed: Mismatched or invlaid currency code in PARES',
        1050 => 'Buyer Authentication Service ó Validate Authentication failed: Mismatched or invlaid XID in PARES',
        1051 => 'Buyer Authentication Service ó Validate Authentication failed: Mismatched or invlaid order date in PARES',
        1052 => 'Buyer Authentication Service ó Validate Authentication failed: This PARES was already validated for a previous Validate Authentication transaction'
    );

    protected $avsMessages = array(
        'A' =>	'Address only (no ZIP code)',
        'B' =>	'International “A”,	Address only (no ZIP code)',
        'C' =>	'International “N”	None, The transaction is declined.',
        'D' =>	'International “X”,	Address and Postal Code',
        'E' =>	'Not allowed for MOTO (Internet/Phone) transactions	Not applicable, The transaction is declined.',
        'F' =>	'UK-specific “X” Address and Postal Code',
        'G' =>	'Global Unavailable	Not applicable',
        'I' =>	'International Unavailable	Not applicable',
        'M' =>	'Address and Postal Code',
        'N' =>	'No	None, The transaction is declined.',
        'P' =>	'Postal (International “Z”)	Postal Code only (no Address)',
        'R' =>	'Retry, Not applicable',
        'S' =>	'Service not Supported, Not applicable',
        'U' =>	'Unavailable, Not applicable',
        'W' =>	'Whole ZIP, Nine-digit ZIP code (no Address)',
        'X' =>	'Exact match, Address and nine-digit ZIP code',
        'Y' =>	'Yes, Address and five-digit ZIP',
        'Z' =>	'ZIP, Five-digit ZIP code (no Address)',
    );

    protected $cvvMessages = array(
        "Y"	=> "Match",
        "N"	=> "No Match",
        "X"	=> "Unavailable",
        "I" => "Invalid",
        "P" => "Not Processed",
        "S" => "Service Not Supported",
        "U" => "Service Not Available",
        "E" => "Error"
    );

    protected $resArray     = array();
    protected $success      = false;
    protected $errors       = array();

    public function __construct($response = null)
    {
        if(is_null($response)) {
            $this->success = false;
            return;
        }

        $this->resArray = $this->deformatNVP($response);
        if($this->resArray['ACK'] == "Success" || $this->resArray['ACK'] == "SuccessWithWarning") {
            $this->success = true;
        } else {
            foreach($this->resArray as $k => $v) {
                if(preg_match('/L_LONGMESSAGE/i', $k)) {
                    $this->errors[] = $v;
                }
            }
            $this->success = false;
        }
    }

    public function getResponse()
    {
        return $this->resArray;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function addError($error)
    {
        array_push($this->errors, $error);

        return $this;
    }

    public function isSuccess()
    {
        return $this->success;
    }

    public function getPaypalTransactionID()
    {
        if(!isset($this->resArray['PPREF'])) {
            return null;
        }

        return $this->resArray['PPREF'];
    }

    public function getAmount()
    {
        if(!isset($this->resArray['AMT'])) {
            return '0.00';
        }

        return $this->resArray['AMT'];
    }

    public function getFeeAmount()
    {
        if(!isset($this->resArray['FEEAMT'])) {
            return '0.00';
        }

        return $this->resArray['FEEAMT'];
    }

    public function getTaxAmount()
    {
        if(!isset($this->resArray['TAXAMT'])) {
            return '0.00';
        }

        return $this->resArray['TAXAMT'];
    }

    /**
     * Get the raw response message if it exists from Paypal
     *
     * @return null|string
     */
    public function getResponseMessage()
    {
        if(!isset($this->resArray['RESPMSG'])) {
            return null;
        }

        return $this->resArray['RESPMSG'];
    }

    /**
     * Get the address verification code returned from Paypal
     *
     * @return string
     */
    public function getAVSCode()
    {
        return isset($this->resArray['AVSCODE']) ? $this->resArray['AVSCODE'] : "U";
    }

    /**
     * Get the Address verification message for a given AVS code
     *
     * @param $code
     * @return string
     */
    public function getAVSAddressMessage($code)
    {
        if(isset($this->avsMessages[$code])) {
            return $this->avsMessages[$code];
        }

        return "Not Available";
    }

    /**
     * Get the CVV code returned from Paypal
     *
     * @return string
     */
    public function getCVVCode()
    {
        return isset($this->resArray['CVV2MATCH']) ? $this->resArray['CVV2MATCH'] : "X";
    }

    /**
     * Get the CVV message for a given CVV response code.
     *
     * @param $code
     * @return string
     */
    public function getCVVMessage($code)
    {
        if(isset($this->cvvMessages[$code])) {
            return $this->cvvMessages[$code];
        }

        return "Not Available";
    }

    /**
     * Parse the return string from Paypal into an Array.
     *
     * @param $nvpstr
     * @return array
     */
    private function deformatNVP($nvpstr)
    {
        $intial=0;
        $nvpArray = array();

        while(strlen($nvpstr)){
            //postion of Key
            $keypos = strpos($nvpstr,'=');

            //position of value
            $valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&') : strlen($nvpstr);

            /*getting the Key and Value values and storing in a Associative Array*/
            $keyval = substr($nvpstr, $intial, $keypos);
            $valval = substr($nvpstr, $keypos+1, $valuepos-$keypos-1);

            //decoding the respose
            $nvpArray[urldecode($keyval)] = urldecode( $valval );
            $nvpstr = substr($nvpstr, $valuepos+1, strlen($nvpstr) );
        }

        return $nvpArray;
    }

    /**
     * Generic accessor for response variables
     *
     * @param $method
     * @param $params
     * @return mixed null|string
     */
    public function __call($method, $params)
    {
        $prefix         = strtolower(substr($method, 0, 3));
        $propertyName   = substr($method, 3);
        if($prefix == "get") {
            if(isset($this->resArray[strtoupper($propertyName)])) {
                return $this->resArray[strtoupper($propertyName)];
            }
        }

        return NULL;
    }
}