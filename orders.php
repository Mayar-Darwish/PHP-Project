<?php
include 'connectDB.php';

try {
    $db = new Database('cafteriPHPproject','root','123456','127.0.0.1','3306');

    if($db){
        
        $db->getAllOrders($db->connect());
    }
} catch (Exception $e) {
    $e->getMessage();
}
?>

