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
if (isset($_GET["errors"])) {
    $errorss = json_decode($_GET["errors"], true);
}
if (isset($_GET["old"])) {
    $formData = json_decode($_GET["old"], true);
}
if (isset($_GET["response"])) {
    $response = json_decode($_GET["response"], true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>KOPPEE - Coffee Shop HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<body>
   
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.html" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">KOPPEE</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav  p-4">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="about.html" class="nav-item nav-link">Products</a>
                    <a href="service.html" class="nav-item nav-link">Users</a>
                    <a href="menu.html" class="nav-item nav-link">Manual Order</a>
                    <a href="contact.html" class="nav-item nav-link">Checks</a>
                </div>
                <div class="navbar-nav ml-auto p-4">
                    <a href="index.html" class="nav-item nav-link active">Admin</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5"
            style="min-height: 200px">
        </div>
    </div>
    <!-- Page Header End -->


    <!-- add product Start -->
    <div class="container-fluid py-2">
        <div class="container">
            <div class="reservation position-relative overlay-top overlay-bottom">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="text-center p-5" style="background: rgba(51, 33, 29, .8);">
                         <div class="fs-4 mb-4">
                                    <span style="color:red;">
                                        <?php if (isset($response['error']))
                                            echo $response['error'];
                                            ?>
                                    </span>
                                      <span style="color:green;">
                                        <?php if (isset($response['succes']))
                                            echo $response['succes'];
                                        ?>
                                    </span>
                                
                                </div>
                            <h1 class="text-white mb-4 mt-5">Add Product</h1>
                            <form class="mb-5" method="post" action="add_Product.php" enctype="multipart/form-data">
                                <div class="form-group row ">
                                    <div class="col-lg-2 col  fs-4">
                                        <label for="product-name" class="text-white col-form-label">Product</label>
                                    </div>
                                    <div class="col-lg-8 col">
                                        <input type="text" class="form-control bg-transparent border-primary p-4"
                                            name="name" id="name" required value="<?php if (isset($formData["name"]))
                                                echo $formData['name']; ?>"/>
                                        <span style="color:red;">
                                            <?php if (isset($errorss['name']))
                                                echo $errorss['name']; ?>
                                        </span>
                                         <span style="color:red;">
                                            <?php if (isset($errorss['name_valid']))
                                                echo $errorss['name_valid']; ?>
                                        </span>
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2 col fs-4">
                                        <label for="product-price" class="text-white col-form-label">Price</label>
                                    </div>
                                    <div class="col-lg-8 col">
                                        <input type="number" class="form-control bg-transparent border-primary p-4"
                                            name="price" id="product-price" required value="<?php if (isset($formData["price"]))
                                                echo $formData['price']; ?>" />
                                                
                                        <span style="color:red;">
                                            <?php if (isset($errorss['price']))
                                                echo $errorss['price']; ?>
                                        </span>
                                          <span style="color:red;">
                                            <?php if (isset($errorss['price_valid']))
                                                echo $errorss['price_valid']; ?>
                                        </span>
                                       
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2 col  fs-4">
                                        <label for="product-cateogry" class="text-white col-form-label">Cateogry</label>
                                    </div>
                                    <div class="col-lg-8 col  fs-4">
                                        <select class="custom-select bg-transparent border-primary px-4"
                                            id="product-cateogry" name="cateogry" style="height: 49px;" required value="<?php if (isset($formData["cateogry"]))
                                                echo $formData['cateogry']; ?>">
                                            <option selected disabled value="">Choose Cateogry</option>
                                            <?php $db = new Database('cafteriPHPproject', 'root', 'Marina.107', 'localhost', '3306');
                                            if ($db) {
                                                $cateogries = $db->getAllCateogries($db->connect());
                                                foreach ($cateogries as $row) {
                                                    echo "<option value={$row['id']}>{$row['name']}</option>";

                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="col-lg-2 col mt-3">
                                        <a href="add_Cateogry_form.php" class="text-light fw-bold">add cateogry</a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2 col fs-4">
                                        <label for="image" class="text-white col-form-label" >Product picture</label>
                                    </div>
                                    <div class="col-lg-8 col">
                                        <input type="file" name="image" class="form-control" id="image" required value="<?php if (isset($formData["image"]))
                                            echo $formData['image']; ?>">
                                        <span style="color:red;">
                                            <?php if (isset($errorss['image']))
                                                echo $errorss['image']; ?>
                                        </span>
                                    </div>
                                </div>
                               
                                <div class="row justify-content-center">
                                    <div class="col-2">
                                        <button class="btn btn-primary btn-block font-weight-bold py-2"
                                            type="submit">save</button>

                                    </div>
                                    <div class="col-2">
                                        <button class="btn btn-primary btn-block font-weight-bold py-2"
                                            type="reset">reset</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add product End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>
    <script src="js/main.js"></script>
</body>

</html>