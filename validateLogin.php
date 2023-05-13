<?php
include 'connectDB.php';

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>';
ini_set('display_errors', 1);
ini_set('display_st((artup_errors', 1);
error_reporting(E_ALL);

echo "<h1> validate login </h1>";
$email = $_POST["email"];
$password = $_POST["password"];

try {
    $loggedIn = false;
    $db = new Database('cafteriPHPproject', 'root', '', '127.0.0.1', '3306');
    $db_Connected = $db->connect();

    $query = "SELECT * FROM `user` WHERE `email`=:email";
    $stmt =  $db_Connected->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch();
    $user_email = $user['email'];
    $user_password = $user['password'];
    $isAdmin = $user['isAdmin'];







    if ($user_email == $email) {

        echo "Email Succeeded";
        if ($user_password == $password) {
            # check if it is admin or not
            if ($isAdmin == 0) {
                $loggedIn = true;
                if($loggedIn){
                    session_start();
                    $_SESSION['user'] = $user['name'];
                    $_SESSION['login'] = true;
                }
                header("Location:userTest.php");
            } else {
                $loggedIn = true;
                if($loggedIn){
                    session_start();
                    $_SESSION['admin'] = $user['name'];
                    $_SESSION['login'] = true;
                }
                header("Location:admintest.php");
            }
        } else {
            header("Location:login.php?error=invalidpassword&email=$user_email");
        }
    } else {
        echo "email not found";
        header("Location:login.php?emailerror=email dosn't exist");
    }
} catch (Exception $e) {
    $e->getMessage();
};
