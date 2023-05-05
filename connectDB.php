<?php
echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>';
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

   
    
}

?>