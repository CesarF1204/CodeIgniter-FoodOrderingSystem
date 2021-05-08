<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
/* 
| ------------------------------------------------------------------- 
|  Stripe API Configuration 
| ------------------------------------------------------------------- 
| 
| You will get the API keys from Developers panel of the Stripe account 
| Login to Stripe account (https://dashboard.stripe.com/) 
| and navigate to the Developers >> API keys page 
| 
|  stripe_api_key            string   Your Stripe API Secret key. 
|  stripe_publishable_key    string   Your Stripe API Publishable key. 
|  stripe_currency           string   Currency code. 
*/ 
$config['stripe_api_key']         = 'sk_test_51InQ4wHY4bgJZaAv2SsodcqirXlPrMc1jwOSQz4YFcIh8DTS8fhwt2B6FqSKV4GJU0enQn9vrCEkhmqLQBJeiBRl00yzaRUoK8'; 
$config['stripe_publishable_key'] = 'pk_test_51InQ4wHY4bgJZaAvGrxqk3xazXUMKu6IlOTpY6O3tLjpTt6NKicbDpIe3aHmUxHjAoHIntoTTw12nqFZjVf7SqG4008mRZgtUv'; 
$config['stripe_currency']        = 'usd';