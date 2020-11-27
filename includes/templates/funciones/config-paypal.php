<?php

require 'paypal/autoload.php';

define('URL_SITIO', 'http://localhost/myfiles/vicongreso');

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AXdMugudFAC8kEn1KuZjPZfvDRYE2DSBcJ8--6RCdxsby_dF-ImHgqMJ0xTY3cXncgRXeSw10uGY9PK4',//Cliente ID
        'EEJN10IteUq2rkuffMa_p8P_aM5b7lMl1SjYT-R4hu6JKXUfZTa6LgAFi0-WY7ulo1lt6M7Vd0NkLpZK'//Secret
    )
);
?>