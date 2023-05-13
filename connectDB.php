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




}

?>