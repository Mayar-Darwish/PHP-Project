<?php
include 'connectDB.php';

echo "<h1> validate Forget Password </h1>";
$errors=[];
$email = $_POST["email"];
$password = $_POST["password"];
echo $password;
$pass_regex = '$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$';
$pass_res = preg_match_all($pass_regex, $password);
echo $pass_res;



if (! $pass_res) {
    echo "Not matched";
    $errors['password'] = "Password should contain capital letter , small letter , special character and digit and Password length should be 8 or more ";
}else{
    echo  "matched";
    $oldData['password']=$password;
}
try {
    $loggedIn = false;
    $db = new Database('cafteriPHPproject', 'root', 'Marina.107', '127.0.0.1', '3306');
    $db_Connected = $db->connect();

    $query = "SELECT * FROM `user` WHERE `email`=:email";
    $stmt =  $db_Connected->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();


    $user = $stmt->fetch();
    $user_email = $user['email'];
    $user_password = $user['password'];
    $isAdmin = $user['isAdmin'];

    if ($user_email == $email && empty($errors)) {

        echo "Email Succeeded";
        try {
            echo "update password";
            $db = new Database('cafteriPHPproject', 'root', 'Marina.107', '127.0.0.1', '3306');
            $db_Connected = $db->connect();
            $query = "UPDATE `user` SET `password`=:password WHERE `email`=:email";

            $stmt = $db_Connected->prepare($query);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $email);
            $res = $stmt->execute();

            echo "update done";
            # check if it is admin or not
            if ($isAdmin == 0) {
                $loggedIn = true;
                if($loggedIn){
                    session_start();
                    $_SESSION['user'] = $user['name'];
                    $_SESSION['login'] = true;
                }
                header("Location:user_Home_Page.php");
            } else {
                $loggedIn = true;
                if($loggedIn){
                    session_start();
                    $_SESSION['admin'] = $user['name'];
                    $_SESSION['login'] = true;
                }
                header("Location:admintest.php");
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        $errors['email'] = "email dosn't exist";
        $error_str = json_encode($errors);
        var_dump($error_str);
        header("Location:forgetPassword.php?errors=".$error_str);
    }
} catch (Exception $e) {
    $e->getMessage();
}
