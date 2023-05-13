<?php
$user_Id = $_GET['orderId'];
echo $user_Id;

include 'connectDB.php';

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>';
ini_set('display_errors', 1);
ini_set('display_st((artup_errors', 1);
error_reporting(E_ALL);


try{
    $db = new Database('cafteriPHPproject', 'root', '', '127.0.0.1', '3306');
    $db_Connected = $db->connect();

    $query = "DELETE FROM `order-product` WHERE `order_id`=:id";
    $stmt = $db_Connected->prepare($query);
    $stmt->bindParam(':id', $user_Id);
    $stmt->execute();

    $query = "DELETE FROM `order` WHERE `id`=:id";
    $stmt = $db_Connected->prepare($query);
    $stmt->bindParam(':id', $user_Id);
    $stmt->execute();
    echo 'deleted';
    header("Location:userOrders.php");
}
catch(Exception $e){
    $e->getMessage();
}
