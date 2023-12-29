<?php
include 'getEnv.php';
use DevCoder\DotEnv;
(new DotEnv(realpath("./") . '/.env'))->load();
Class Database{

  //private $server = "mysql:host=localhost;dbname=harkonec_sendasap;charset=utf8mb4";
  //private $username = "harkonec_sendasap";
  //private $password = "Whyarewefriends1";
  private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
  protected $conn;

  public function open(){
    
    $db_server = "mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_DATABASE').";charset=".getenv('DB_CHARSET');
    $db_username = getenv('DB_USERNAME');
    $db_password = getenv('DB_PASSWORD');
    
     try{
       $this->conn = new PDO($db_server, $db_username, $db_password, $this->options);
       return $this->conn;
     }
     catch (PDOException $e){
       echo "There is some problem in connection: " . $e->getMessage();
     }

    }

  public function close(){
       $this->conn = null;
   }

}
// error_reporting(E_ALL);
$pdo = new Database();
?>
