<?php 

 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require  'start.php';

//  use PayPal\Api\Payer;
//  use PayPal\Api\Details;
//  use PayPal\Api\Amount;
//  use PayPal\Api\Transaction;
//  use PayPal\Api\Payment;
//   use PayPal\Api\RedirectUrls;

 

//  $payer =  new Payer();
//  $details =  new Details();
//  $amount  = new Amount();
//  $transaction = new Transaction();
//  $payment = new Payment();
//  $redirectUrl = new RedirectUrls();

//  //payer 

//  $payer->setPaymentMethod('paypal');

//  //Details
//   $details->setShipping('2.00')
//           ->setTax('0.00')
//           ->setSubtotal('20.00');
//  //Amount
//   $amount->setCurrency('USD')
//           ->setTotal('22.00')
//           ->setDetails($details);
  
//   //Transaction
//   $transaction->setAmount($amount)
//               ->setDescription('Order placement');   

//   //Redirect Url
//   $redirectUrl->setReturnUrl('https://codephree.com/pay.php?approved=true')
//                 ->setCancelUrl('https://codephree.com/pay.php?approved=false');
  
  
//  // $redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
//               //->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");
    
//   //Payment
//   $payment->setIntent('sales')
//           ->setPayer($payer)
//           ->setTransactions([$transaction]);

$amount = '22.00';

$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setTotal('1.00');
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("https://codephree.com/paypal/pay.php?approval=true")
    ->setCancelUrl("https://codephree.com/paypal/pay.php?approval=false");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

try {
     
     $payment->create($api);
     
     
 } catch(\PayPal\Exception\PayPalConnectionException  $ex){
    echo $ex->getCode(); // Prints the Error Code
    echo $ex->getData(); // Prints the detailed error message 
    die($ex);
} catch (Exception $ex) {
    die($ex);
}
 
 $payment->setRedirectUrls($redirectUrls);
 
 foreach($payment->getLinks() as $links)
 {
      if($links->getRel() == "approval_url")
      {
          $redirectUrl = $links->getHref();
      }
 }
 
 //var_dump($redirectUrl);
 
 
 header("Location: ". $redirectUrl);










