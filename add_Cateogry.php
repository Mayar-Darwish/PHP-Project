<?php
include 'connectDB.php';
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>';
ini_set('display_errors', 1);
ini_set('display_st((artup_errors', 1);
error_reporting(E_ALL);

$errors = [];
$name = $_POST["name"];


if (isset($name) and empty($name)) {
  $errors['name'] = 'Name is required';
} else if (preg_match("{/^[a-zA-Z-' ]*$/}", $name != 1)) {
    $errors['name_valid'] = "Only letters and white space allowed";
  
}

if ($errors) {
  $errors_Str = json_encode($errors);
  $url = "Location:add_Cateogry_form.php?errors={$errors_Str}";
  header($url);
} else {
  try {

    $db = new Database('cafteriPHPproject', 'root', 'Marina.107', 'localhost', '3306');
    if($db){
        $new_cateogry['name'] = "{$name}";
        $db->add_Cateogry($db->connect(),$new_cateogry); 
  }
} catch (Exception $ex) {
    echo $ex->getMessage();
  }
  
}


?>