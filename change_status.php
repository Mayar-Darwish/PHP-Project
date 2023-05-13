<?php
include 'connectDB.php';

$product_id=$_GET['id'];
$status=$_GET['status'];


try {
    $db = new Database('cafteriPHPproject','root','123456','127.0.0.1','3306');
   
    if($db){
        
        $db->changestatus($db->connect(),$product_id,$status);
       
    }    
} catch (Exception $e) {
    $e->getMessage();
}
?>