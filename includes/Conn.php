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
        //Including the constants.php file to get the database constants
        include_once dirname(__FILE__) . '/Constants.php';
 
        //connecting to mysql database
        try{
        $con = new PDO("mysql:host=localhost;dbname=biashara", "root", "");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    }catch(PDOException $error){
            echo "Connection failed: " . $error->getMessage();
        }
        
    }
 
}