<?php
include 'connectDB.php';
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
            <a href="index.php" class="navbar-brand px-lg-4 m-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="mb-5" style="width: 7rem; height: 7rem;"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="3232.49147254704"
                    height="3221.4545790511766" viewBox="0 0 3232.49147254704 3221.4545790511766">
                    <g transform="scale(11.624573627351998) translate(10, 10)">
                        <defs id="SvgjsDefs1032"></defs>
                        <g id="SvgjsG1033" featureKey="DMynUx-0"
                            transform="matrix(1.5896820152402011,0,0,1.5896820152402011,49.93341345598969,-15.260947952721494)"
                            fill="#da9f5b">
                            <path xmlns="http://www.w3.org/2000/svg"
                                d="M94.7,45.8H81.9C79.8,25.4,62.6,9.6,41.7,9.6C19.4,9.6,1.3,27.6,1.3,49.9c0,22.3,18.1,40.4,40.4,40.4  c20.9,0,38.1-15.9,40.2-36.2h12.8c2.3,0,4.1-1.9,4.1-4.1C98.9,47.7,97,45.8,94.7,45.8z M41.7,83.8C23,83.8,7.8,68.6,7.8,49.9  c0-18.7,15.2-33.9,33.9-33.9c18.7,0,33.9,15.2,33.9,33.9C75.5,68.6,60.4,83.8,41.7,83.8z">
                            </path>
                            <path xmlns="http://www.w3.org/2000/svg"
                                d="M41.7,19.1c-17,0-30.8,13.8-30.8,30.8s13.8,30.8,30.8,30.8c17,0,30.8-13.8,30.8-30.8S58.7,19.1,41.7,19.1z M32.1,39  c1.1-2.8,3.3-4.9,5.3-5.3c-1,1.3-2,3.3-1.6,6l0,0c0.5,3.6-0.5,6-1.7,7c-0.1,0-0.2,0-0.3,0C31.4,46,30.6,42.6,32.1,39z M38.8,64.6  c-1.7,1.8-5.1,0.8-7.5-2.1c-1.9-2.3-2.7-5.2-2.2-7.2c0.7,1.4,2,3.3,4.5,4.3l0,0c3.4,1.3,5.1,3.2,5.4,4.8  C38.9,64.5,38.9,64.5,38.8,64.6z M39.7,62.8c-0.9-1.8-2.9-3.4-5.7-4.4v0c-2.7-1-3.8-3.3-4.2-4.5c0,0,0-0.1,0.1-0.1  c1.7-1.8,5.1-0.8,7.5,2.1C39.2,58.2,40.1,60.8,39.7,62.8z M40.7,41.3c-1.1,2.6-3,4.6-5,5.2c1.1-1.6,1.6-4.2,1.2-7.1v0  c-0.4-2.9,1.1-4.9,2-5.8c0,0,0.1,0,0.1,0C41.4,34.3,42.1,37.7,40.7,41.3z M44.5,55.8c-1.8-1.7-0.8-5.1,2.1-7.5  c2.2-1.8,4.9-2.6,6.9-2.3c-1.8,0.9-3.4,2.9-4.4,5.7v0C48.1,54.4,45.8,55.5,44.5,55.8C44.6,55.8,44.6,55.8,44.5,55.8z M53.2,54.4  c-2.3,1.9-5.2,2.7-7.2,2.2c1.4-0.7,3.3-2,4.3-4.5h0c1.3-3.4,3.2-5.1,4.8-5.4c0.1,0.1,0.1,0.1,0.2,0.2C57.1,48.5,56.2,51.9,53.2,54.4  z">
                            </path>
                        </g>
                        <g id="SvgjsG1034" featureKey="xgcenu-0"
                            transform="matrix(6.41644751251658,0,0,6.41644751251658,-8.157681510629615,106.67166166978794)"
                            fill="#ffffff">
                            <path
                                d="M12.712 6.441000000000001 c0.16949 0 0.33915 0.15254 0.33915 0.32203 l0 12.915 c0 0.16949 -0.13559 0.32186 -0.32203 0.32186 l-0.55932 0 c-0.45763 0 -0.94915 -0.32203 -1.5593 -1 l-6.9322 -7.7456 l0 8.4068 c0 0.16949 -0.15254 0.32203 -0.33915 0.32203 l-1.7288 0.016784 c-0.18644 0 -0.33898 -0.15238 -0.33898 -0.33881 l0 -12.898 c0 -0.16949 0.15254 -0.32203 0.32203 -0.32203 l1 0 c0.18644 0 0.30508 0.067797 0.45763 0.25424 l7.5763 8.678 l0 -8.6102 c0 -0.16949 0.13559 -0.32203 0.32203 -0.32203 l1.7627 0 z M23.610033898305083 14.7629 c0.22034 0 0.3222 0.10136 0.3222 0.32154 l0 1.661 c0 0.18661 -0.13559 0.33898 -0.32203 0.33898 l-0.77966 0 l0 2.5932 c0 0.20339 -0.11864 0.32203 -0.32203 0.32203 l-1.6442 0 c-0.18644 0 -0.35593 -0.15238 -0.35593 -0.32186 l0 -2.5932 l-5.0678 0 c-0.16949 0 -0.33898 -0.13559 -0.33898 -0.32203 l-0.016949 -1.661 c0 -0.11864 0.050847 -0.22034 0.15254 -0.27119 c1.5085 -1.2373 2.7458 -2.9322 3.4914 -4.8307 c0.39 -1.0168 0.50864 -1.8303 0.52559 -2.8981 c0 -0.18644 0.13543 -0.32203 0.32203 -0.32203 l1.8475 0 c0.20339 0 0.33898 0.15254 0.33898 0.33898 c-0.050847 1.7966 -0.50847 3.5932 -1.1525 4.9153 c-0.49153 0.94915 -1.2373 1.9153 -2.1017 2.7288 l2 0 l0 -0.72881 c0 -0.18644 0.15238 -0.33898 0.32203 -0.37271 l1.661 -0.15254 c0.20339 -0.016949 0.33898 0.15271 0.33898 0.3561 l0 0.89831 l0.77966 0 z M41.152915254237286 6.441000000000001 c0.18644 0 0.33915 0.15238 0.33915 0.32186 l0 12.898 c0 0.16949 -0.13559 0.33881 -0.3222 0.33881 l-1.7456 0 c-0.20339 0 -0.33898 -0.15238 -0.33898 -0.33881 l0 -8.2203 l-4.9492 7.8305 c-0.10186 0.16949 -0.20356 0.23729 -0.3561 0.23729 l-0.10169 0 c-0.15254 0 -0.25424 -0.067797 -0.35593 -0.23729 l-4.9322 -7.8475 l0 8.2375 c0 0.16949 -0.15254 0.33881 -0.33898 0.33881 l-1.7458 0 c-0.18644 0 -0.33898 -0.15238 -0.33898 -0.33881 l0 -12.898 c0 -0.16949 0.13559 -0.32203 0.33898 -0.32203 l1.4576 0 c0.16949 0 0.28814 0.067797 0.38983 0.22034 l5.5763 8.8134 l5.5932 -8.8134 c0.084746 -0.15254 0.20339 -0.22034 0.38983 -0.22034 l1.4407 0 z">
                            </path>
                        </g>
                        <g id="SvgjsG1035" featureKey="jZLKOX-0"
                            transform="matrix(0.751539702573828,0,0,0.751539702573828,16.70642227807892,242.02019513530678)"
                            fill="#ffffff">
                            <path
                                d="M8.3398 4.18 l-0.0097656 0.039063 c1.0938 0 2.1191 0.20508 3.0859 0.625 s1.8164 0.98633 2.5488 1.6992 l-2.2461 2.2461 c-0.94727 -0.9375 -2.0703 -1.4063 -3.3691 -1.4063 c-1.3184 0 -2.4414 0.46875 -3.3691 1.4063 s-1.3965 2.0605 -1.3965 3.3691 c0 1.3184 0.46875 2.4414 1.3965 3.3691 s2.0508 1.3965 3.3691 1.3965 s2.4414 -0.46875 3.3789 -1.4063 l2.2461 2.2461 c-0.73242 0.72266 -1.582 1.2891 -2.5488 1.709 s-1.9922 0.625 -3.0859 0.625 c-2.1875 0 -4.0625 -0.78125 -5.6152 -2.334 s-2.334 -3.4277 -2.334 -5.6152 s0.78125 -4.0625 2.334 -5.625 s3.4277 -2.3438 5.6152 -2.3438 z M44.2880734375 14.7949 l2.7832 0 l-1.3867 -3.2715 z M42.9990734375 17.5781 l-0.019531 -0.0097656 c-0.35156 0.80078 -0.71289 1.5918 -1.0742 2.3926 l-3.3887 0 l7.1387 -15.996 l7.1582 15.996 l-3.3984 0 c-0.35156 -0.79102 -0.70313 -1.5918 -1.0547 -2.3828 l-5.3613 0 z M78.1171875 4.257999999999999 l9.4434 0 l0 3.1445 l-6.2891 0 l0 3.1543 l4.7168 0 l0 3.1445 l-4.7168 0 l0 3.1445 l0 3.1543 l-3.1543 0 l0 -6.2988 l0 -3.1445 l0 -6.2988 z M112.8349609375 4.257999999999999 l9.4434 0 l0 3.1445 l-6.2891 0 l0 3.1543 l4.7168 0 l0 3.1445 l-4.7168 0 l0 3.1445 l6.2891 0 l0 3.1543 l-6.2891 0 l-3.1543 0 l0 -15.742 z M151.585953125 4.257999999999999 l3.1543 0 l3.9355 0 l0 3.1445 l-3.9355 0 l0 12.598 l-3.1543 0 l0 -12.598 l-3.9355 0 l0 -3.1445 l3.9355 0 z M184.1455078125 4.257999999999999 l9.4434 0 l0 3.1445 l-6.2891 0 l0 3.1543 l4.7168 0 l0 3.1445 l-4.7168 0 l0 3.1445 l6.2891 0 l0 3.1543 l-6.2891 0 l-3.1543 0 l0 -15.742 z M219.15625 20 l-0.0097656 -15.762 l5.1172 0 c1.5137 0 3.0078 0.52734 4.0918 1.6113 s1.5234 2.0996 1.5234 3.6133 l0 0.48828 c0 1.1719 -0.33203 2.0313 -0.99609 2.9688 s-1.2207 1.2109 -2.2559 1.6016 l3.5547 5.4785 l-3.8477 0 l-4.0234 -6.1523 l0 6.1523 l-3.1543 0 z M222.3008 11.8164 l2.2559 0.0097656 c0.6543 0 0.98633 -0.16602 1.4453 -0.625 s0.625 -0.98633 0.625 -1.6406 c0 -0.64453 -0.16602 -1.0742 -0.625 -1.543 s-1.2793 -0.63477 -1.9336 -0.63477 l-1.7676 0 l0 4.4336 z M255.7490234375 20 l0 -15.742 l3.1543 0 l0 15.742 l-3.1543 0 z M289.919909375 14.7949 l2.7832 0 l-1.3867 -3.2715 z M288.630909375 17.5781 l-0.019531 -0.0097656 c-0.35156 0.80078 -0.71289 1.5918 -1.0742 2.3926 l-3.3887 0 l7.1387 -15.996 l7.1582 15.996 l-3.3984 0 c-0.35156 -0.79102 -0.70313 -1.5918 -1.0547 -2.3828 l-5.3613 0 z">
                            </path>
                        </g>
                    </g>
                </svg>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav  p-4 mb-5">
                    <a href='admintest.php' class='nav-item nav-link active'>Home</a>
                    <a href='Product_table.php' class='nav-item nav-link'>Products</a>
                    <a href='allUser.php' class='nav-item nav-link '>Users</a>
                    <a href='orders.php' class='nav-item nav-link '>Manual Order</a>
                    <a href='Checks.php' class='nav-item nav-link'>Checks</a>
                </div>
                <div class="navbar-nav ml-auto p-4">

                    <a href="#" class=" mb-5 nav-item nav-link active">
                        Admin
                    </a>
                    <a href="index.php" class=" mb-5 nav-item nav-link ">
                        LogOut
                    </a>
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
                                                echo $formData['name']; ?>" />
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
                                        <label for="image" class="text-white col-form-label">Product picture</label>
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