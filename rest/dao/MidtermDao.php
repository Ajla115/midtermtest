<?php

class MidtermDao {

    private $conn;

    /**
    * constructor of dao class
    */
    public function __construct(){
        try {

        /** TODO
        * List parameters such as servername, username, password, schema. Make sure to use appropriate port
        */

        //ovo je primjer kako ce raditi kad je baza na Digital Oceans
        /*$host = 'burch-test-db-web-do-user-14103948-0.b.db.ondigitalocean.com';
        $database = 'midterm-2023-test';
        $username = 'doadmin';
        $password = 'AVNS_Nzw-rNS2t2ScuR64P8u';
        $port = 25060;*/
  
        $servername = 'localhost';
        $username = 'root';
        $password = 'a1b2c3d4e5';
        $schema = 'midterm-2023';
  
     
        /*options array neccessary to enable ssl mode - do not change*/
        $options = array(
        	PDO::MYSQL_ATTR_SSL_CA => 'https://drive.google.com/file/d/1g3sZDXiWK8HcPuRhS0nNeoUlOVSWdMAg/view?usp=share_link',
        	PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,

        );

        /** TODO
        * Create new connection
        * Use $options array as last parameter to new PDO call after the password
        */
         
        //takoder ce onda i ovdje trebati dodati options kao argumenat kad je deployed na Digital Oceans
        //$this->conn = new PDO("mysql:host=$host;port= $port;dbname=$database", $username, $password, $options); 
         
        
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema", $username, $password);

        // set the PDO error mode to exception
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          echo "Connected successfully";
        } catch(PDOException $e) {
          echo "Connection failed: " . $e->getMessage();
        }
    }

    /** TODO
    * Implement DAO method used to get cap table
    */
    public function cap_table(){
      $query="SELECT * FROM cap_table";
      $stmt = $this->conn->prepare($query); 
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getShareClass($share_class_id){
      $query = "SELECT * FROM share_classes WHERE id = :share_class_id";
      $stmt = $this->conn->prepare($query); 
      //$stmt->bindParam(':share_class_id', $share_class_id); //to prevent SQL injection, which is a security issue
      //ovo sa dolar znakom je iz poziva funkcje a ovo sa tackom je isto tako samo treba 
      $stmt->execute(['share_class_id' => $share_class_id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getShareClassCategory($share_class_category_id){
      $query = "SELECT * FROM share_class_categories WHERE id = :share_class_category_id";
      $stmt = $this->conn->prepare($query); 
      //$stmt->bindParam(':share_class_category_id', $share_class_category_id); //to prevent SQL injection, which is a security issue
      //ovo sa dolar znakom je iz poziva funkcje a ovo sa tackom je isto tako samo treba 
      $stmt->execute(['share_class_category_id' => $share_class_category_id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getInvestor($investor_id){
      $query = "SELECT * FROM investors WHERE id = :investor_id";
      $stmt = $this->conn->prepare($query); 
      //$stmt->bindParam(':investor_id', $investor_id); //to prevent SQL injection, which is a security issue
      //ovo sa dolar znakom je iz poziva funkcje a ovo sa tackom je isto tako samo treba 
      $stmt->execute(['investor_id' => $investor_id]);
      return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /** TODO
    * Implement DAO method used to get summary
    */
    public function summary(){
      $query = "SELECT COUNT(DISTINCT investor_id) AS total_investors, SUM(diluted_shares) AS total_shares
      FROM cap_table";
      $stmt = $this->conn->prepare($query); 
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);

      //drugi nacin da se uradi
      /*$stmt = $this->conn->prepare("SELECT COUNT(DISTINCT investor_id) AS total_investors, SUM(diluted_shares) AS total_shares
      FROM cap_table"); 
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);*/
    }

    /** TODO
    * Implement DAO method to return list of investors with their total shares amount
    */
    public function investors(){
      $query="SELECT i.company, i.first_name, i.last_name, SUM(c.diluted_shares) AS total_shares
      FROM investors i
      JOIN cap_table c ON i.id=c.investor_id
      GROUP BY i.id";
      $stmt = $this->conn->prepare($query); 
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
