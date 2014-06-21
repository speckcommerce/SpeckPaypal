<?php
namespace SpeckPaypal\Response;

class TransactionSearchResponse extends Response
{
    protected $_multiFieldMap = array(
        'ERRORS'  => array(
            'LONGMESSAGE',
            'SEVERITYCODE',
            'SHORTMESSAGE',
            'ERRORCODE'
        ),
        'RESULTS' => array(
            'TIMESTAMP',
            'TIMEZONE',
            'TYPE',
            'EMAIL',
            'NAME',
            'TRANSACTIONID',
            'STATUS',
            'AMT',
            'CURRENCYCODE',
            'FEEAMT',
            'NETAMT'
        )
    );    
}