<?php
include 'connectDB.php';

$order = trim(file_get_contents("php://input"));

$_arr = json_decode($order, true);



$db = new Database('cafteriPHPproject', 'root', 'Marina.107', 'localhost', '3306');
if ($db) {

    $db->add_order($db->connect(), $_arr);
   

}
// echo json_encode(['success' => true]);
exit();

?>