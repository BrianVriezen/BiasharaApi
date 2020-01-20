<?php 
	
	//adding dboperation file 
	require_once '../includes/Operations.php';
	
	//response array 
	$response = array(); 
	
	//if a get parameter named op is set we will consider it as an api call 
	if(isset($_GET['op'])){
		
		//switching the get op value 
		switch($_GET['op']){
			
			//if it is add user 
			//that means we will add an user
			case 'adduser':

				
				if(isset($_POST['phone']) && isset($_POST['password']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['gender']) && isset($_POST['date']))
				{
					$options = [
						'cost' => 12 // the default cost is 10
					];
					$hash = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
					$phoneInt = (int)$_POST['phone'];
					$db = new Operation(); 
          $id = 003;
          //com_create_guid();
					if($db->Register($id, $phoneInt, $hash, $_POST['email'], $_POST['firstname'], $_POST['middlename'], $_POST['lastname'],$_POST['address'], $_POST['city'], $_POST['state'], $_POST['zipcode'], $_POST['country'], $_POST['gender'], $_POST['date']))
					{
						$response['error'] = false;
						$response['message'] = 'User added successfully';
					}else{
						$response['error'] = true;
						$response['message'] = 'Could not add user';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break; 


      //if it is getlogin that means we are fetching the records
      
      case 'getlogin':
        $phonenmbr = 18654;
        $password = 'pass';
				if(isset($phonenmbr) && isset($password))
				{
					$phoneInt = (int)$phonenmbr;
					$db = new Operation(); 
          //$id = com_create_guid();
          //echo $phonenmbr;
          //echo $phoneInt;
          echo $db->getLogin($phoneInt, $password);
					if($db->getLogin($phoneInt, $password))
					{
						$response['error'] = false;
						$response['message'] = 'User login successfully';
					}else{

						$response['error'] = true;
						$response['message'] = 'Could not login user';
					}
				}else{
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break; 
		}
		
	}else{
		$response['error'] = false; 
		$response['message'] = 'Invalid Request';
	}
	
	//displaying the data in json 
	echo json_encode($response);