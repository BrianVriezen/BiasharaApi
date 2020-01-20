<?php
 
//phpinfo();


class Operation
{
    private $con;
 
    function __construct()
    {
        require_once dirname(__FILE__) . '/Conn.php';
        $db = new Conn();
        $this->con = $db->connect();
    }
 
    
	//adding a record to database 
	public function Register($id, $phoneInt, $hash, $email, $firstname, $middlename, $lastname, $address, $city, $state, $zipcode, $country, $gender, $date){
		$stmt = $this->con->prepare("INSERT INTO users (id, phone, password, email, firstname, middlename, lastname, address, city, state, zipcode, country, gender, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sissssssssssss", $id, $phoneInt, $hash, $email, $firstname, $middlename, $lastname, $address, $city, $state, $zipcode, $country, $gender, $date);
		if($stmt->execute())
			return true; 
		return false; 
	}
	
	public function getLogin($phoneInt, $password){
    $sql = "SELECT * FROM users WHERE phone = ?";
    if($stmt2=$this->con->prepare($sql))
    {
    $stmt2->bind_param("i", $phoneInt);
		$stmt2->execute();
		$count = $stmt2->num_rows;
		if ($count > 0)
		{
			
			if(password_verify($password, $row['password']))
			{
				
				return true; 
			}
			else
			{
				return true; 
			}
						
		}
		else
		{
      echo $stmt2->error;
			return false;
    }
  }
  else{
    echo "phone: ". $phoneInt;
    var_dump($this->con->error);
  }
	}
}

