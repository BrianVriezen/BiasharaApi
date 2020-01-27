<?php

class Conn
{
    //Variable to store database link
    public $con;
    
    

    //Class constructor
    function __construct()
    {
 
    }
 
    //This method will connect to the database
    function connect()
    {
      $dbname = "biashara";
      $servername = "localhost";
      $username = "root";
      $password = "";

        //Including the constants.php file to get the database constants
        include_once dirname(__FILE__) . '/Constants.php';
 
        //connecting to mysql database
        try{
            $conn = new PDO("mysql:host=".$servername.";dbname=".$dbname."", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }catch(PDOException $error){
            echo "Connection failed: " . $error->getMessage();
        }
        
    }
 
}