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
        $host = 'burch-test-db-web-do-user-14103948-0.b.db.ondigitalocean.com';
        $database = 'midterm-2023-test';
        $username = 'doadmin';
        $password = 'AVNS_Nzw-rNS2t2ScuR64P8u';
        $port = 25060;
        
     
    

        /*options array neccessary to enable ssl mode - do not change*/
        $options = array(
        	PDO::MYSQL_ATTR_SSL_CA => 'https://drive.google.com/file/d/1g3sZDXiWK8HcPuRhS0nNeoUlOVSWdMAg/view?usp=share_link',
        	PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,

        );
        /** TODO
        * Create new connection
        * Use $options array as last parameter to new PDO call after the password
        */

        $this->conn = new PDO("mysql:host=$host;port= $port;dbname=$database", $username, $password, $options); 

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

    }

    /** TODO
    * Implement DAO method used to get summary
    */
    public function summary(){

    }

    /** TODO
    * Implement DAO method to return list of investors with their total shares amount
    */
    public function investors(){

    }
}
?>
