<?php
include 'connectDB.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';
echo "<div class='container'> ";
echo "<h1> update </h1>";

// var_dump($_GET);
// var_dump($_GET['name']);

$updateName = $_GET['name'];
$updateEmail = $_GET['email'];
$updatePassword = $_GET['password'];
$updateRoomName = $_GET['roomId'];
$updateExt = $_GET['ext'];
// var_dump($updateExt);
// var_dump($updateRoomName);
$userId = $_GET['id'];


try {

    $db = new Database('cafteriPHPproject', 'root', 'Marina.107', '127.0.0.1', '3306');
    $table = "user";
    $updateExt = $_GET['ext'];
    $data = $db->update($table, $updateName, $updateEmail, $updatePassword, $updateExt, $userId);
    // var_dump($data);
    $updateRoom = $db->updateRoom($updateRoomName, $userId);
} catch (Exception $e) {
    echo $e->getMessage();
}

header('location:allUser.php');
