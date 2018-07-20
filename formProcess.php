<?php
session_start();
$username  = $_POST['username'];  //email
$email  =  $_POST['email'];
$pay  =  $_POST['pay'];

try {
    $db = new PDO('mysql:host=localhost;dbname=stancone_paypal', 'stancone_root', 'XywYaR7xq$I*');
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO users (username,email, pay)
                   VALUES ('$username','$email', '$pay')";
                
             // use exec() because no results are returned
    if($db->exec($sql))
    {
        $_SESSION['user_id'] = $db->lastInsertId();
    }
    
    header("Location: index.php");
    
} catch(PDOException $ex)
{
    echo $sql . "<br>" . $e->getMessage();
}
