<?php

require 'src/start.php';
 
$paymentID = checkGET($_GET['paymentId']);
$approval =  checkGET($_GET['approval']);
$token =  checkGET($_GET['token']);  //PayerID
$PayerID =  checkGET($_GET['PayerID']);
$userId = $_SESSION['user_id'];

if($approval == 'true')
{
    try {
        
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql1 = "UPDATE users SET pay='1' WHERE id= '$userId'";

        // Prepare statement
        $stmt = $db->prepare($sql1);
    
        // execute the query
        if($stmt->execute())
        {
             $sql = "INSERT INTO order_table (user_id,paymentID, payerID, complete)
                   VALUES ('$userId','$paymentID', '$PayerID', '1')";
                
             // use exec() because no results are returned
            $db->exec($sql);
        }
        
        header("Location: success.php");
        
      } catch(PDOException $e)
      
    {
        echo $sql . "<br>" . $e->getMessage();
    }
    
   } else if($approval == 'false') {
    
    header("Location: failure.php");
    
}

function checkGET($data) {
  if(isset($data))
  {
        return $data;
  }
}