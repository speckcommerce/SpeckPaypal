<?php
return array(
    'express-options' => array(
        'url'					=> 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=',
        'return'				=> 'http://staging.speckcommerce.com/checkout/confirm-order',
        'cancel'				=> 'http://staging.speckcommerce.com/cart',
        'callback'				=> 'http://staging.speckcommerce.com:8800/service/paypal-callback'
    ),

    'api' => array(
       'username' 				=> 'support_api1.silkempire.com',
       'password' 				=> '5BGT3TXP76BHT7N2',
       'signature'				=> 'AK-5v5Tl4OBBtGGlEyezDrRnyZFeA.bs3tDfnwyjeVknLQc6mEIbwfDe',
       'endpoint'               => 'https://api-3t.sandbox.paypal.com/nvp'
    )
);