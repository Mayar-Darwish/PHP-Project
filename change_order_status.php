<?php
include 'connectDB.php';

$order_id=$_GET['id'];
$status=$_GET['status'];

try {
    $db = new Database('cafteriPHPproject','root','Marina.107','127.0.0.1','3306');
   
    if($db){  
       
        $db->changeorderstatus($db->connect(),$order_id,$status);  

    }    
} catch (Exception $e) {
    $e->getMessage();
}
?>