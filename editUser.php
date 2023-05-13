<?php
include 'connectTODB.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>';

$userId = $_GET['id'];

try {
    $db = new Database('cafteriPHPproject', 'root', '', '127.0.0.1', '3306');
    $table = "user";
    $data = $db->selecrByID("$table", "$userId");
    // var_dump($data);
    // var_dump($data[0]['Name']);
    $roomId = $data[0]['room_id'];
    // var_dump($roomId);
    // var_dump($data[0]['ext']);

    #query of room Name
    $roomData = $db->getRoom($roomId);
    // var_dump($roomData);
} catch (Exception $e) {
    $e->getMessage();
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" </head>

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
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 200px">
        </div>
    </div>
    <!-- Page Header End -->
    <!-- Reservation Start -->



    <div class="container-fluid py-2">
        <div class="container">
            <div class="reservation position-relative overlay-top overlay-bottom">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="text-center p-5" style="background: rgba(51, 33, 29, .8);">
                            <h1 class="text-white mb-4 mt-5">All Users</h1>
                            <!-- <input type="text" class="form-control bg-transparent border-primary p-4" id="product-name" -->
                            <div class="fs-4 mb-4">
                                <span style="color:red;">


                                    <form method="get" action="updateUser.php">

                                        <div class="form-group row my-4">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputEmail3" name="name" value=<?php echo $data[0]['Name']; ?>>
                                            </div>
                                        </div>
                                        <div class='form-group row my-4'>
                                            <label for='inputEmail3' class='col-sm-2 col-form-label'>Email</label>
                                            <div class='col-sm-10'>
                                                <input type='email' class='form-control' id='inputEmail3' name='email' value=<?php echo $data[0]['email']; ?>>
                                            </div>
                                        </div>
                                        <div class='form-group row my-4'>
                                            <label for='inputEmail3' class='col-sm-2 col-form-label'>Password</label>
                                            <div class='col-sm-10'>
                                                <input type='password' class='form-control' id='inputEmail3' name='password' value=<?php echo $data[0]['password']; ?>>
                                            </div>
                                        </div>
                                        <div class='form-group row my-4'>
                                            <label for='inputEmail3' class='col-sm-2 col-form-label'>Room Number</label>
                                            <div class='col-sm-10'>
                                                <input type='text' class='form-control' id='inputEmail3' name='roomId' value=<?php echo $roomData['roomName']; ?>>
                                            </div>
                                        </div>
                                        <div class='form-group row my-4'>
                                            <label for='inputEmail3' class='col-sm-2 col-form-label'>EXT</label>
                                            <div class='col-sm-10'>
                                                <input type='text' class='form-control' id='inputEmail3' name='ext' value=<?php echo $data[0]['ext']; ?>>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id" value=<?php echo $userId; ?> />


                                        <div>

                                            <button type='submit' class='btn btn-primary my-4'>save Update</button>
                                        </div>

                                    </form>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Reservation End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>