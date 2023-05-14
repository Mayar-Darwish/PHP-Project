<?php
include 'connectDB.php';
$db = new Database('cafteriPHPproject', 'root', 'Marina.107', 'localhost', '3306');
if ($db) {
        $product = $db->select_product_ByID($db->connect(), $_GET['id']);
        echo json_encode(["product" => $product]);
}
?>