<?php
 
//phpinfo();
include 'Conn.php';

class Operation
{
    private $db;
 
    function __construct()
    {
        require_once dirname(__FILE__) . '/Conn.php';
        $this->db = new Conn();
        $this->db->connect();
    }
 
    
	//adding a record to database 
	public function Register($id, $phoneInt, $hash, $email, $firstname, $middlename, $lastname, $address, $city, $state, $zipcode, $country, $gender, $date){
        $con = new PDO("mysql:host=localhost;dbname=biashara", "root", "");
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql1= "INSERT INTO users (id, phone, password, email, firstname, middlename, lastname, address, city, state, zipcode, country, gender, date)
		VALUES (:id, :phone, :password, :email, :firstname, :middlename, :lastname, :address, :city, :state, :zipcode, :country, :gender, :date)";
		$stmt = $con->prepare($sql1);

		$stmt -> bindparam(':id', $id);
		$stmt -> bindparam(':phone', $phoneInt);
		$stmt -> bindparam(':password', $hash);
		$stmt -> bindparam(':email', $email);
		$stmt -> bindparam(':firstname', $firstname);
		$stmt -> bindparam(':middlename', $middlename);
		$stmt -> bindparam(':lastname', $lastname);
		$stmt -> bindparam(':address', $address);
		$stmt -> bindparam(':city', $city);
		$stmt -> bindparam(':state', $state);
		$stmt -> bindparam(':zipcode', $zipcode);
		$stmt -> bindparam(':country', $country);
		$stmt -> bindparam(':gender', $gender);
		$stmt -> bindparam(':date', $date);
		$stmt->execute();
			
	}
	
	public function getLogin($phoneInt, $password){
	$sql = "SELECT * FROM users WHERE phone = :phone";
	$con = new PDO("mysql:host=localhost;dbname=biashara", "root", "");
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt1 = $con->prepare($sql);
    
	$stmt1 -> bindparam(':phone', $phoneInt);
	$stmt1->execute();
	
	if ($stmt1->rowCount()>0){
		$row = $stmt1->fetch(PDO::FETCH_ASSOC);
	//$_SESSION['phone'] = $result['phone'];
	if(password_verify($password, $row['password']))
            {

                return true; 
            }
            else
            {
                return false; 
            }

						
	}else{
        return false;
    }
}
}