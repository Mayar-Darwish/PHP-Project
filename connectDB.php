<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database
{
    protected $DB_DATABASE;
    protected $DB_USER;
    protected $DB_PASSWORD;
    protected $DB_HOST;
    protected $PORT;

    public function __construct(string $DB_DATABASE, string $DB_USER, string $DB_PASSWORD, string $DB_HOST, string $PORT)
    {
        $this->DB_DATABASE = $DB_DATABASE;
        $this->DB_USER = $DB_USER;
        $this->DB_PASSWORD = $DB_PASSWORD;
        $this->DB_HOST = $DB_HOST;
        $this->PORT = $PORT;
    }

    function connect()
    {
        $user = $this->DB_USER;
        $password = $this->DB_PASSWORD;

        try {
            $dsn = "mysql:dbname={$this->DB_DATABASE};host={$this->DB_HOST};port={$this->PORT};";
            $db = new PDO($dsn, $user, $password);
            if ($db) {
                return $db;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    function  getAllCateogries($db){
        $select_query = "select * from `cafteriPHPproject`.`cateogry`";
        $select_stmt = $db->prepare($select_query);
        $select_stmt->execute();
        $data = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;

    }

    function add_Product($db,$newProduct){
        try {

            $insert_query = "insert into `cafteriPHPproject`.`product` (name,price,image, cateogry_id) values (:name, :price, :image, :cateogry_id);";
            $insert_statm = $db->prepare($insert_query);
            $insert_statm->bindParam(":name", $newProduct['name'], PDO::PARAM_STR);
            $insert_statm->bindParam(":price", $newProduct['price'], PDO::PARAM_INT);
            $insert_statm->bindParam(":image", $newProduct['image'], PDO::PARAM_STR);
            $insert_statm->bindParam(":cateogry_id", $newProduct['cateogry'], PDO::PARAM_INT);


            $response = $insert_statm->execute();
            if ($response == false) {
                $DBResponse['error'] = 'please review data!';
            } else {
                $DBResponse['succes'] = 'Product added successfully';
            }
            $DBResponse_Str = json_encode($DBResponse);
            header("Location:add_Product_form.php?response={$DBResponse_Str}");


        }catch (Exception $e) {
            echo $e->getMessage();
        }


    }

    function add_Cateogry($db, $newCateogry){
        try {
                       
            $insert_query = "insert into `cafteriPHPproject`.`cateogry` (name) values (:name);";
            $insert_statm = $db->prepare($insert_query);
            $insert_statm->bindParam(":name", $newCateogry['name'], PDO::PARAM_STR);
            $response = $insert_statm->execute();
            if ($response == false) {
                $DBResponse['error'] = 'This Cateogry already exists!';
            } else {
                $DBResponse['succes'] = 'Cateogry added successfully';
            }
            $DBResponse_Str = json_encode($DBResponse);
            header("Location:add_Cateogry_form.php?response={$DBResponse_Str}");


        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
    function select_available_Products($db){
        $select_query = "select * from `cafteriPHPproject`.`product` where `product_status`='Available'; ";
        $select_stmt = $db->prepare($select_query);
        $select_stmt->execute();
        $products = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;


    }

    function select_product_ByID($db,$id){
        $select_query = "select * from `cafteriPHPproject`.`product` where `product_status`='Available' and `id`=:id ; ";
        
        $select_stmt = $db->prepare($select_query);
        $select_stmt->bindParam(":id", $id);
        $select_stmt->execute();
        $product = $select_stmt->fetch(PDO::FETCH_ASSOC);
        return $product;



    }

    function select_rooms($db)
    {
        $select_query = "select * from `cafteriPHPproject`.`room`; ";

        $select_stmt = $db->prepare($select_query);
        $select_stmt->execute();
        $rooms = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($rooms);
        return $rooms;



    }
    function add_order($db,$order){
        var_dump($order);
      
        try {
            # insert in order table 
            $user_id = 1;
           
            $insert_query = "insert into `cafteriPHPproject`.`order` (notes,totalPrice,user_id,room_id) values(:notes,:totalPrice,:user_id,:room_id);";
            $insert_statm = $db->prepare($insert_query);
            $insert_statm->bindParam(":notes", $order['note'], PDO::PARAM_STR);
            $insert_statm->bindParam(":user_id",$user_id, PDO::PARAM_INT);
            $insert_statm->bindParam(":totalPrice", $order["OrdertotalPrice"], PDO::PARAM_INT);
            $insert_statm->bindParam(":room_id", $order['room'], PDO::PARAM_INT);
            $response = $insert_statm->execute();


            # insert into order-product table  
            $orderID = $db->lastInsertId();

            foreach ($order['products'] as $row) {
               var_dump($row);
                $insert_query = "insert into `cafteriPHPproject`.`order-product` (amount,product_id,order_id,totalProductPrice) values(:amount,:product_id,:order_id,:totalProductPrice);";
                $insert_statm = $db->prepare($insert_query);
                $insert_statm->bindParam(":amount", $row['quantity'], PDO::PARAM_INT);
                $insert_statm->bindParam(":product_id", $row['id'], PDO::PARAM_INT);
                $insert_statm->bindParam(":order_id", $orderID, PDO::PARAM_INT);
                $insert_statm->bindParam(":totalProductPrice", $row['totalPrice'], PDO::PARAM_INT);
                $response = $insert_statm->execute();
                var_dump($response);
            }
        

             
            
             echo json_encode(['success' => false]);


            
           

           
             
         
    


    
          //  header("Location:user_Home_Page.php");


        } catch (Exception $e) {
            echo $e->getMessage();
        }
        


    }









    //////////////




    function getAllProducts($connection_obj, string $table_name){
        try {
        $select_all_query = "select id,name,price,image,product_status from `product`";
        $select_stmt = $connection_obj->prepare($select_all_query);
        $select_stmt->execute();
        $Products = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
      
       

        
echo"

<!-- Navbar Start -->
<div class='container-fluid p-0 nav-bar'>
    <nav class='navbar navbar-expand-lg bg-none navbar-dark py-3'>
        <a href='index.html' class='navbar-brand px-lg-4 m-0'>
            <h1 class='m-0 display-4 text-uppercase text-white'>KOPPEE</h1>
        </a>
        <button type='button' class='navbar-toggler' data-toggle='collapse' data-target='#navbarCollapse'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse justify-content-between' id='navbarCollapse'>
            <div class='navbar-nav  p-4'>
                <a href='./coffee-shop-html-template/index.html' class='nav-item nav-link active'>Home</a>
                <a href='./coffee-shop-html-template/about.html' class='nav-item nav-link'>Products</a>
                <a href='./coffee-shop-html-template/service.html' class='nav-item nav-link'>Users</a>
                <a href='./coffee-shop-html-template/menu.html' class='nav-item nav-link'>Manual Order</a>
                <a href='./coffee-shop-html-template/contact.html' class='nav-item nav-link'>Checks</a>
            </div>
            <div class='navbar-nav ml-auto p-4'>
                <a href='./coffee-shop-html-template/index.html' class='nav-item nav-link active'>Admin</a>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->    <!-- Page Header Start -->
<div class='container-fluid page-header mb-5 position-relative overlay-bottom'>
    <div class='d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5' style='min-height: 200px'>
    </div>
</div>
<!-- Page Header End -->    <!-- Reservation Start -->
<div class='container-fluid py-2'>
    <div class='container'>
        <div class='reservation position-relative overlay-top overlay-bottom'>
            <div class='row align-items-center'>
                <div class='col-lg-12'>
                    <div class='text-center p-5' style='background: rgba(51, 33, 29, .8);'>
                    <div class='d-flex justify-content-between'>
                        <h1 class='text-white mb-4 mt-3 '>All Products</h1>
                        <a href='add_Product_form.php' class='text-white mb-10 mt-5'>Add Product<a/>
                        </div>
                         <table class='table text-center  text-white'  >
                         <thead>
                         <th> Name </th>
                         <th> Price </th>
                         <th> Image </th>
                         <th> Status </th>
                         <th> Edit </th>
                         <th> Delete </th>
                         </thead>
                         <tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Reservation End -->    <!-- Back to Top -->
<a href='#' class='btn btn-lg btn-primary btn-lg-square back-to-top'><i class='fa fa-angle-double-up'></i></a>    <!-- JavaScript Libraries -->
<script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
<script src='lib/easing/easing.min.js'></script>
<script src='lib/waypoints/waypoints.min.js'></script>
<script src='lib/owlcarousel/owl.carousel.min.js'></script>
<script src='lib/tempusdominus/js/moment.min.js'></script>
<script src='lib/tempusdominus/js/moment-timezone.min.js'></script>
<script src='lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js'></script>    <!-- Contact Javascript File -->
<script src='mail/jqBootstrapValidation.min.js'></script>
<script src='mail/contact.js'></script>    <!-- Template Javascript -->
<script src='js/main.js'></script>


";

       
        foreach ($Products as $product) {
            echo "<tr>";
            foreach ($product as $index=>$value) {
                if($index == 'image'){
                   // echo "<td>img</td>";
                    echo "<td> <img src='images/{$value}' width='50' height='50' /> </td>";
                }elseif($index== 'product_status'){
                    echo "<td><a class='btn btn-info' href='change_status.php?id={$product['id']}&status={$product['product_status']}'>{$product['product_status']}</a></td>";
                }
                elseif($index == 'id'){
                    continue;
               }
                
                else{
                    echo "<td> {$value} </td>";
                }
            }
            echo "<td><a class='btn btn-warning' href='update_product_form.php?id={$product['id']}'>Edit</a></td>";
            echo "<td><a class='btn btn-danger' href='delete_product.php?id={$product['id']}'>Delete</a></td>";
           
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }




    function changestatus($connection_obj,$product_id,$status){
        
        if($status=='Available')
        {
        
            $update_by_id_query = "update `product` set `product_status`= 'UnAvailable' where id=:id;";
        }else
        {
            $update_by_id_query = "update `product` set `product_status`= 'Available' where id=:id;";
        }
       
        $update_stmt = $connection_obj->prepare($update_by_id_query);
        $update_stmt->bindParam(":id", $product_id,PDO::PARAM_STR);
      
        
        $response=$update_stmt->execute();
        var_dump($response);
        header("Location:Product_table.php");

        
    

}



    function deleteUserById($connection_obj,$id){
               try{
                $delete_by_id_query = "delete from `cafteriPHPproject`.`product` where `id`=:id ;";
                $delete_stmt = $connection_obj->prepare($delete_by_id_query);

                $delete_stmt->bindParam(":id",$id);
                $delete_stmt->execute();
                header("Location:Product_table.php");
                

               
                
            } 
            catch(Exception $e){
                $e->getMessage();
            }
      
    }







    function updateProductById($connection_obj, $new_data){
                $update_by_id_query = "update `product` set `name`=:name, `price`=:price,`image`=:image where id=:id";
                $update_stmt = $connection_obj->prepare($update_by_id_query);
                $update_stmt->bindParam(":id", $new_data['id'], PDO::PARAM_INT);
                $update_stmt->bindParam(":name", $new_data['name'], PDO::PARAM_STR);
                $update_stmt->bindParam(":price", $new_data['price'], PDO::PARAM_INT);
                $update_stmt->bindParam(":image", $new_data['image'], PDO::PARAM_STR);

                $response=$update_stmt->execute();
                var_dump($response);
               

                if($response != true ) {
                    $DBResponse['succes'] = 'Product updated successfully';
                } else {
                    $DBResponse['error'] = 'fils to update product!';

                    
                }
                $DBResponse_Str = json_encode($DBResponse);
                header("Location:update_product_form.php?response={$DBResponse_Str}");
                
            
     
}




    // function  getAllCateogries($db){
    //     $select_query = "select * from `cafteriPHPproject`.`cateogry`";
    //     $select_stmt = $db->prepare($select_query);
    //     $select_stmt->execute();
    //     $data = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $data;

    // }




    function  getAllOrders($db){
        try{
        $select_query ="select O.date,O.id,U.name,R.roomName,U.ext,O.status,P.image,P.price,OP.amount,O.totalPrice
                        from product P
                        inner join `order-product` OP 
                           on P.id = OP.product_id
                        inner join `order` O 
                           on OP.order_id = O.id 
                        inner join room R 
                           on O.room_id = R.id 
                        inner join user U 
                           on R.id = U.room_id ;";
        $select_stmt = $db->prepare($select_query);
        $select_stmt->execute();
        $orders = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
       
       

        echo"

        <!-- Navbar Start -->
        <div class='container-fluid p-0 nav-bar'>
            <nav class='navbar navbar-expand-lg bg-none navbar-dark py-3'>
                <a href='index.html' class='navbar-brand px-lg-4 m-0'>
                    <h1 class='m-0 display-4 text-uppercase text-white'>KOPPEE</h1>
                </a>
                <button type='button' class='navbar-toggler' data-toggle='collapse' data-target='#navbarCollapse'>
                    <span class='navbar-toggler-icon'></span>
                </button>
                <div class='collapse navbar-collapse justify-content-between' id='navbarCollapse'>
                    <div class='navbar-nav  p-4'>
                        <a href='./coffee-shop-html-template/index.html' class='nav-item nav-link active'>Home</a>
                        <a href='./coffee-shop-html-template/about.html' class='nav-item nav-link'>Products</a>
                        <a href='./coffee-shop-html-template/service.html' class='nav-item nav-link'>Users</a>
                        <a href='./coffee-shop-html-template/menu.html' class='nav-item nav-link'>Manual Order</a>
                        <a href='./coffee-shop-html-template/contact.html' class='nav-item nav-link'>Checks</a>
                    </div>
                    <div class='navbar-nav ml-auto p-4'>
                        <a href='./coffee-shop-html-template/index.html' class='nav-item nav-link active'>Admin</a>
                    </div>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->    <!-- Page Header Start -->
        <div class='container-fluid page-header mb-5 position-relative overlay-bottom'>
            <div class='d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5' style='min-height: 200px'>
            </div>
        </div>
        <!-- Page Header End -->    <!-- Reservation Start -->
        <div class='container-fluid py-2'>
            <div class='container'>
                <div class='reservation position-relative overlay-top overlay-bottom'>
                    <div class='row align-items-center'>
                        <div class='col-lg-12'>
                            <div class='text-center p-5' style='background: rgba(51, 33, 29, .8);'>
                            <div class='d-flex justify-content-between'>
                                <h1 class='text-white mb-4 mt-3 '>Orders</h1>
                                </div>
                                 <table class='table text-center  text-white'  >
                                 <thead>
                                
                                 <th> Date </th>
                                 <th> Name </th>
                                 <th> Room Number </th>
                                 <th> Ext </th>
                                 <th> Status </th>
                                 <th> Image </th>
                                 <th> Price </th>
                                 <th> Amount </th>
                                
                                 </thead>

                                 
                                 <tbody>

                                
                                
                            </div>
                        </div>

                               
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reservation End -->    <!-- Back to Top -->
        <a href='#' class='btn btn-lg btn-primary btn-lg-square back-to-top'><i class='fa fa-angle-double-up'></i></a>    <!-- JavaScript Libraries -->
        <script src='https://code.jquery.com/jquery-3.4.1.min.js'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
        <script src='lib/easing/easing.min.js'></script>
        <script src='lib/waypoints/waypoints.min.js'></script>
        <script src='lib/owlcarousel/owl.carousel.min.js'></script>
        <script src='lib/tempusdominus/js/moment.min.js'></script>
        <script src='lib/tempusdominus/js/moment-timezone.min.js'></script>
        <script src='lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js'></script>    <!-- Contact Javascript File -->
        <script src='mail/jqBootstrapValidation.min.js'></script>
        <script src='mail/contact.js'></script>    <!-- Template Javascript -->
        <script src='js/main.js'></script>
        
        
        ";


   
        foreach ($orders as $order) {
            echo "<tr>";
            foreach ($order as $index=>$value) {
                if($index == 'image'){
                   // echo "<td>img</td>";
                    echo "<td> <img src='images/{$value}' width='50' height='50' /> </td>";
                }
                elseif($index == 'id'){
                     continue;
                }
                elseif($index == 'totalPrice'){
                    continue;
               }
                elseif($index== 'status'){
                    echo "<td><a class='btn btn-info' href='change_order_status.php?id={$order['id']}&status={$order['status']}'> {$order['status']} </a></td>";
                }else{
                    echo "<td> {$value} </td>";
                }
            }
     
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        
        echo " <div>
                 <h4 class='text-white mb-3 mt-3 d-flex justify-content-end'>Total Price </h4>
                 
               </div>";
        echo" <div>
                <h3 class='text-white mb-4 d-flex justify-content-end'>{$order['totalPrice']}</h3>
            </div>";       
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
 



    function changeorderstatus($connection_obj,$order_id,$status){
        
        if($status=='processing')
        {

            $update_by_id_query = "update `order` set `status`= 'out for delivery' where id=:id;";
        }elseif($status=='out for delivery')
        {
            $update_by_id_query = "update `order` set `status`= 'done' where id=:id;";
        }
        else
        {
            $update_by_id_query = "update `order` set `status`= 'done' where id=:id;";
        }
       
        $update_stmt = $connection_obj->prepare($update_by_id_query);
        $update_stmt->bindParam(":id", $order_id,PDO::PARAM_STR);
      
        
        $response=$update_stmt->execute();
        var_dump($response);
        header("Location:orders.php");

        
}
}

?>







