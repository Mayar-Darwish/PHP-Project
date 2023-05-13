<?php
include 'connectDB.php';
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