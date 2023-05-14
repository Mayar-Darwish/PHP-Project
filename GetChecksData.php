<?php
include 'connectDB.php';

var_dump($_GET);
$db = new Database('cafteriPHPproject','root','Marina.107','127.0.0.1','3306');
$connected=$db->connect();
if ((isset($_GET['startDate']) and empty($_GET['startDate']) )and( isset($_GET['endDate']) and empty($_GET['endDate'])))
{
    $query = "SELECT id,date , totalPrice FROM `order` WHERE `user_id`=:userid ";
    $stmt=$connected->prepare($query);
    $stmt->bindParam(":userid",$_GET['user']);

}elseif (isset($_GET['endDate']) and empty($_GET['endDate'])){
    $query = "SELECT id,date , totalPrice FROM `order` WHERE date >=  :startDate And `user_id`=:userid ";
    $stmt=$connected->prepare($query);
    $stmt->bindParam(":startDate",$_GET['startDate']);
    $stmt->bindParam(":userid",$_GET['user']);
}elseif(isset($_GET['startDate']) and empty($_GET['startDate'])){
    $query = "SELECT id,date , totalPrice FROM `order` WHERE date <=  :endDate And `user_id`=:userid ";
$stmt=$connected->prepare($query);
$stmt->bindParam(":endDate",$_GET['endDate']);
$stmt->bindParam(":userid",$_GET['user']);
}else{
    $query = "SELECT id,date , totalPrice FROM `order` WHERE date BETWEEN :startDate AND :endDate And `user_id`=:userid ";
    $stmt=$connected->prepare($query);
    $stmt->bindParam(":startDate",$_GET['startDate']);
    $stmt->bindParam(":endDate",$_GET['endDate']);
    $stmt->bindParam(":userid",$_GET['user']);
}
$stmt->execute();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_GET['order'])){
    $data=json_decode($_GET['oldData']);
    $query = "SELECT `name`, `price`, `image`, `amount`
                FROM `product`, `order-product`, `order`
                WHERE `product`.id = `order-product`.product_id AND  `order`.id= `order-product`.order_id AND `order`.id= :id";
    $stmt=$connected->prepare($query);
    $stmt->bindParam(":id",$_GET['order']);
    $stmt->execute();
    $products=$stmt->fetchAll(PDO::FETCH_ASSOC);
    $products=json_encode($products);
}

$orders=json_encode($data);
header("Location:Checks.php?orders=$orders&products=$products");