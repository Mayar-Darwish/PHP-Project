<?php
include 'connectDB.php';

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>';
ini_set('display_errors', 1);
ini_set('display_st((artup_errors', 1);
error_reporting(E_ALL);
$date1 = $_POST["startDate"];
$date2 = $_POST["endDate"];
session_start();

if($_SESSION['login']){
    $userId= $_SESSION['id'];
}
try{
    $db = new Database('cafteriPHPproject', 'root', 'Marina.107', '127.0.0.1', '3306');
    $db_Connected = $db->connect();
    if((isset($date1) and empty($date1) )and( isset($date2) and empty($date2))){
        $query = "SELECT * FROM `order`  WHERE `order`.user_id = $userId";
        $stmt = $db_Connected->prepare($query);
    }
    elseif(isset($date2) and empty($date2)) {

        $query = "SELECT * FROM `order` WHERE date >=  :date1 AND `order`.user_id = $userId";
         $stmt = $db_Connected->prepare($query);
         $stmt->bindParam(':date1', $date1);
    }
    elseif(isset($date1) and empty($date1)){
        $query = "SELECT * FROM `order` WHERE date <=  :date2 AND `order`.user_id = $userId";
        $stmt = $db_Connected->prepare($query);
         $stmt->bindParam(':date2', $date2);
    }
    else{
    $query = "SELECT * FROM `order` WHERE date BETWEEN :date1 AND :date2 AND `order`.user_id = $userId ";
    $stmt = $db_Connected->prepare($query);
    $stmt->bindParam(':date1', $date1);
    $stmt->bindParam(':date2', $date2);
    }
    $res = $stmt->execute();

    $orders = $stmt->fetchAll();
    $ordersArray = json_encode($orders);
    header("Location:userOrders.php?orders={$ordersArray}");
}
catch(Exception $e){
$e->getMessage();
}