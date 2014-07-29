SpeckPaypal
===========

A generic module for adding PayPal Payments support to a ZF2 application.

[![Build Status](https://secure.travis-ci.org/speckcommerce/SpeckPaypal.png)](http://travis-ci.org/speckcommerce/SpeckPaypal)

Introduction
------------

SpeckPaypal is a module that can be utilized outside of Speck Commerce to accept payments via paypal.
This module currently supports PayPal Payments Pro and Express Checkout API Operations.

Please see: [Paypal API Docs](https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/howto_api_reference)

To integrate with this module you will want to sign up for a sandbox account on Paypal. See the developer website for instructions.

This module currently supports the following calls with API version 95.0:
* Callback
* DoAuthorization
* DoCapture
* DoDirectPayment
* DoExpressCheckoutPayment
* DoVoid
* GetBalance
* GetExpressCheckoutDetails
* GetTransactionDetails
* RefundTransaction
* SetExpressCheckout
* TransactionSearch
* UpdateRecurringPaymentsProfile
* ManageRecurringPaymentsProfileStatus
* CreateRecurringPaymentsProfile

Requirements
------------

The dependencies for SpeckCommerce are set up as Git submodules so you should not hav
* PHP 5.4+ (Note: This library should work with PHP 5.3.3+ however official support is no longer provided)
* [Zend Framework 2](https://github.com/zendframework/zf2) (latest master)


Contributors
------------

* [Steve Rhoades] (https://github.com/SteveRhoades) (IRC: srhoades) [![Build Status](https://secure.travis-ci.org/steverhoades/SpeckPaypal.png)](http://travis-ci.org/steverhoades/SpeckPaypal)


Community
---------

Join us on the Freenode IRC network: #speckcommerce. Our numbers are few right
now, but we're a dedicated small group working on this project full time.


Example Usage
-------------

Create a Paypal Request Object:
<pre>
//setup config object
$config = array(
    'username'      => 'your_username',
    'password'      => 'your_password',
    'signature'     => 'your_signature',
    'endpoint'      => 'https://api-3t.sandbox.paypal.com/nvp' //this is sandbox endpoint
)
$paypalConfig = new \SpeckPaypal\Element\Config($config);

//set up http client
$client = new \Zend\Http\Client;
$client->setMethod('POST');
$client->setAdapter(new \Zend\Http\Client\Adapter\Curl);
$paypalRequest = new \SpeckPaypal\Service\Request;
$paypalRequest->setClient($client);
$paypalRequest->setConfig($paypalConfig);
</pre>

Direct Payment Example (by default the request is sent as "Sale" which is equivalent to Authorize Capture):
<pre>
$paymentDetails = new \SpeckPaypal\Element\PaymentDetails(array(
    'amt' => '10.00'
));

$payment = new \SpeckPaypal\Request\DoDirectPayment(array('paymentDetails' => $paymentDetails));
$payment->setCardNumber('4744151425799438');
$payment->setExpirationDate('112017');
$payment->setFirstName('John');
$payment->setLastName('Canyon');
$payment->setIpAddress('255.255.255.255');
$payment->setCreditCardType('Visa');
$payment->setCvv2('345');

$address = new \SpeckPaypal\Element\Address;
$address->setStreet('27 Your Street');
$address->setStreet2('Apt 23');
$address->setCity('Some City');
$address->setState('California');
$address->setZip('92677');
$address->setCountryCode('US');
$payment->setAddress($address);

$response = $paypalRequest->send($payment);

echo $response->getTransactionId();
</pre>

Express Checkout Example:
<pre>
$paymentDetails = new \SpeckPaypal\Element\PaymentDetails(array(
    'amt' => '20.00'
));
$express = new \SpeckPaypal\Request\SetExpressCheckout(array('paymentDetails' => $paymentDetails));
$express->setReturnUrl('http://www.someurl.com/return');
$express->setCancelUrl('http://www.someurl.com/cancel');

$response = $paypalRequest->send($express);

echo $response->isSuccess();

$token = $response->getToken();
$payerId = $response->getPayerId();

//To capture express payment
$captureExpress = new \SpeckPaypal\Request\DoExpressCheckoutPayment(array(
    'token'             => $token,
    'payerId'           => $payerId,
    'paymentDetails'    => $paymentDetails
));
$response = $paypalRequest->send($captureExpress);

echo $response->isSuccess();
</pre>

Transaction Search Example:
<pre>
$transactionSearch new \SpeckPaypal\Request\TransactionSearch();
$transactionSearch->setStartDate('2014-06-21T00:00:00Z');

$paypalRequest = $serviceManager->get('SpeckPaypal\Service\Request');
$response = $paypalRequest->send($transactionSearch);

var_dump($response->getResults());
</pre>

TODO
----
* better validation based on paypal requirements (currently validation is loose)
* refactor to relevant exception classes
* add support for ebay items, survey questions ... and other missing payments pro apis