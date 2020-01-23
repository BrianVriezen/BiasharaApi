<?php 
	
	//adding dboperation file 
	require_once '../includes/Operations.php';
	
	//response array 
	$response = array(); 
	$postData = json_decode(file_get_contents("php://input"), true);	

	//if a get parameter named op is set we will consider it as an api call 
	if(isset($_GET['op'])){
		
		//switching the get op value 
		switch($_GET['op']){
			
			//if it is add user 
			//that means we will add an user
			case 'adduser':

				
				if(isset($postData['phone']) && isset($postData['password']) && isset($postData['firstname']) && isset($postData['lastname']) && isset($postData['gender']) && isset($postData['date']))
				{
					$options = [
						'cost' => 12 // the default cost is 10
					];
					$hash = password_hash($postData['password'], PASSWORD_DEFAULT, $options);
					$phoneInt = (int)$postData['phone'];
					$db = new Operation(); 
          $id = 003;
          //com_create_guid();
					if($db->Register($id, $phoneInt, $hash, $postData['email'], $postData['firstname'], $postData['middlename'], $postData['lastname'], $postData['address'], $postData['city'], $postData['state'], $postData['zipcode'], $postData['country'], $postData['gender'], $postData['date']))
					{
						$response['success'] = true;
						$response['error'] = false;
						$response['message'] = 'User added successfully';
					}else{
						$response['success'] = false;
						$response['error'] = true;
						$response['message'] = 'Could not add user';
					}
				}else{
					$response['success'] = false;
					$response['error'] = true; 
					$response['message'] = 'Required Parameters are missing';
				}
			break; 


      //if it is getlogin that means we are fetching the records
      
      case 'getlogin':
		if(isset($postData['phone']) && isset($postData['password']))
		{
			$phoneInt = (int)$postData['phone'];
			$db = new Operation(); 
			$id = 3;//com_create_guid();
			if($db->getLogin($phoneInt, $postData['password']))
			{
				$response['success'] = true;
				$response['error'] = false;
				$response['message'] = 'User login successfully';
			}else{
				$response['success'] = false;
				$response['error'] = true;
				$response['message'] = 'Could not login user';
			}
		}else{
			$response['success'] = false;
			$response['error'] = true; 
			$response['message'] = 'Required Parameters are missing';
		}
	break;
		}
		
	}else{
		$response['success'] = false;
		$response['error'] = false; 
		$response['message'] = 'Invalid Request';
	}
	
	//displaying the data in json 
	echo json_encode($response);