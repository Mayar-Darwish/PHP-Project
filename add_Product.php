<?php
include 'connectDB.php';
ini_set('display_errors', 1);
ini_set('display_st((artup_errors', 1);
error_reporting(E_ALL);

$errors = [];
$formData = [];
$name = $_POST["name"];
$price = $_POST["price"];
$cateogry = $_POST["cateogry"];
$image = $_FILES["image"];

if (isset($name) and empty($name)) {
  $errors['name'] = 'Name is required';
} else {
  $formData['name'] = $_POST['name'];
  if (!preg_match ("/^[a-zA-z]*$/", $name) ) {  
    $errors['name_valid'] = "Only letters and white space allowed!";
  }
}

if (isset($price) and empty($price)) {
  $errors['price'] = 'price is required';
} else {
  $formData['price'] = $_POST['price'];
  if ($price<=0) {
    $errors['price_valid'] = "Only Positive Numbers";
  }
}

if (isset($cateogry) and empty($cateogry)) {
  $errors['cateogry'] = 'cateogry is required';
} else {
  $formData['cateogry'] = $_POST['cateogry'];
}







if ($errors) {
  $errors_Str = json_encode($errors);
  $url = "Location:add_Product_form.php?errors={$errors_Str}";
  if ($formData) {
    $oldData = json_encode($formData);
    $url .= "&old={$oldData}";
  }
  header($url);
} else {
  try {
    $imagename = '';
    if (isset($_FILES['image']) and !empty($_FILES['image']['name'])) {
      $imagename = $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];
      $ext_name = pathinfo($imagename)['extension'];
      if (in_array($ext_name, ['png', 'jpg','jpeg'])) {
        $uploaded = move_uploaded_file($tmp_name, "images/$imagename");
      }
    }

   
    $db = new Database('cafteriPHPproject','root','Marina.107','localhost','3306');
    if($db){
        $newProduct['name'] = "{$name}";
        $newProduct['price'] = "{$price}";
        $newProduct['cateogry'] = "{$cateogry}";
        $newProduct['image'] = "{$imagename}";
        $db->add_Product($db->connect(), $newProduct);
  }
} catch (Exception $ex) {
    echo $ex->getMessage();
  }
  
}


?>