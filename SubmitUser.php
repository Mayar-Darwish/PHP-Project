<?php
include 'connectDB.php';
echo '
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
     crossorigin="anonymous"></script>';
ini_set('display_errors', 1);
ini_set('display_st((artup_errors', 1);
error_reporting(E_ALL);


$errors = [];
$oldData=[];
$name = $_POST["name"];
$email = $_POST["email"];
$password =$_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$roomNo = $_POST["roomNo"];
$ext = $_POST["ext"];
$profilePic = $_FILES["profilePic"];


if (isset($profilePic['name'])and empty($profilePic['name'])){
    $errors['profilePic']= "Profile Picture is required";
}
if (isset($name) and empty($name)) {
    $errors['name'] = 'Name is required';
} else if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
    $errors['name_valid'] = "Only letters and white space allowed for Name";
}else{
    $oldData['name']=$name;
}

if (isset($email) and empty($email)) {
    $errors['email'] = 'Email is required';
} else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $errors['email_valid'] = "Invalid Email format";
}else{
    $oldData['email']=$email;
}

if (isset($password) and empty($password)) {
    $errors['password'] = 'Password is required';
} else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password)) {
    $errors['pass_valid'] = "Password should contain capital letter , small letter , special character and digit and Password length should be 8 or more ";
}else{
    $oldData['password']=$password;
}

if (isset($confirmPassword) and empty($confirmPassword)) {
    $errors['confirmPass'] = 'Confirm your Password';
}else{
    $oldData['confirmPass']=$confirmPassword;
}

if ($password != $confirmPassword){
    $errors['matchedPass']="Two Passwords should be equals";
}
if (isset($roomNo) and empty($roomNo)) {
    $errors['roomNo'] = 'Choose room';
}else{
    $oldData['roomNO']=$roomNo;
}
if (isset($ext) and empty($ext)) {
    $errors['ext'] = 'EXT. is required';
}else if(!preg_match("/^\\d+$/",$ext)){
    $errors['ext_valid']="EXT. should be only digits";
}else{
    $oldData['ext']=$ext;
}

if ($errors){
    $err_str= json_encode($errors);
    $oldData_str=json_encode($oldData);
    header('Location:AddUser.php?errors='.$err_str.'&oldData='.$oldData_str);
}else{
    if (isset($_FILES['profilePic']) and !empty($_FILES['profilePic']['name'])){
        $imgName=$_FILES['profilePic']['name'];
        $tmpName=$_FILES['profilePic']["tmp_name"];
        $extName=pathinfo($imgName)['extension'];
        $id=time();
        $newImgName="images/profiles/{$id}.{$extName}";
        if (in_array($extName,['png','jpg','PNG','JPG'])) {
            try {
                $upload = move_uploaded_file($tmpName, $newImgName);

            } catch (Exception $e) {
                var_dump($e->getMessage());
            }
        }
    }
    try {


    $db=new Database('cafteriPHPproject','root','Marina.107','127.0.0.1','3306');
    $connected=$db->connect();
    
    $query="insert into `user` (`name`,`email`,`image`,`ext`,`password`,`room_id`) values (:name,:email,:image,:ext,:password,:room_id)";
    $stmt=$connected->prepare($query);
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":image",$newImgName);
    $stmt->bindParam(":ext",$ext);
    $stmt->bindParam(":password",$password);
    $stmt->bindParam("room_id",$roomNo);
    
    $stmt->execute();


    }catch (Exception $e){
        var_dump($e->getMessage());
    }
   header('Location:AddUser.php?msg=User added successfully');
}




