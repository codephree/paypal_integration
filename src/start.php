<?php

  use PayPal\Rest\ApiContext;
  use PayPal\Auth\OAuthTokenCredential;

  session_start();

  if(!isset($_SESSION['user_id']))
  {
      header("Location: form.php");
  }

  require __DIR__ . '/../vendor/autoload.php';

  //API

  $api = new ApiContext(
        new  OAuthTokenCredential(
            'AR2tc4dMNGuC0pt8CkvJGLviQQV-QF0QFA67bP30gAJVzcsQ9DQHbRIyoQxgnA0aGoFTXJqIc5JrcVI2',
            'EDXtRSwFSc6DXSCveUJzQIClNF_7_ldDp71hAxh5aDTHJ-MLeGL7DFJZE5orouksGx-gZd4cacZLYIIX'
         )   
      );

  $api->setConfig([
       'mode' => 'sandbox',
       'http.ConnectionTimeOut' => 30,
       'log.LogEnabled' => false,
       'log.FileName'  =>  '/logs/paypal.log',
       'log.LogLevel'  =>  'FINE',
       'validation.level' => 'log'


  ]);


  $db = new PDO('mysql:host=localhost;dbname=stancone_paypal', 'stancone_root', 'XywYaR7xq$I*');

  $user = $db->prepare("
     SELECT * FROM users
     WHERE id = :user_id
    ");

    $user->execute(['user_id' => $_SESSION['user_id']]);

    $user = $user->fetchObject();
?>
