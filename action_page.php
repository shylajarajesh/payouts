<?php
	require_once("configsetup.php");
	session_start();
	if(!empty($_POST))
	{		
		if($_POST["submit"] == "add_login")
		{
				$user_name = trim($_POST["user_name"]);
				$password = trim($_POST["password"]);
				$enc_pass = md5(trim($_POST["password"]));
				
				
				$select = $database->query("SELECT username, password FROM login_details WHERE username = '$user_name' and password = '$password'");
				$query = $database->fetchArray();
				
				if(!empty($query))
				{
					$dbuser = $query['username']; 
					$dbpass = $query['password'];
					
					$_SESSION['user_name'] = $dbuser;
					$_SESSION['password'] = $dbpass;
					
					header("Location: user_details.php");
				}
				else{
					header("Location: index.php?error=error");
				}
				
				//$insert_login = $database->query("INSERT INTO login_details (username, password, enc_pass) VALUES ('$user_name', '$password', '$enc_pass');");
		}
		//exit;
		if($_POST["submit"] == "add_user")
		{
			$firstname = trim($_POST["firstname"]);
			$lastname  = trim($_POST["lastname"]);
			$mobileno  = trim($_POST["mobileno"]);
			
			$select = $database->query("SELECT * FROM user_details WHERE mobileno = '$mobileno'");
			$query = $database->fetchArray();
			//print_r($query);
			//exit;
			
			if(empty($query))
			{			
				$insert = $database->query("INSERT INTO user_details (firstname, lastname, mobileno) VALUES ('$firstname', '$lastname', '$mobileno')");
				if(!empty($insert)){
				
						$_SESSION['mobileno'] = $query['mobileno'];
						header("Location: add_bene.php");
				}
				else{
					header("Location: user_details.php?error=error");
				}
				
			}
			else
			{	$_SESSION['mobileno'] = $mobileno;
				$select_bene = $database->query("SELECT * FROM add_bene WHERE user_mobno = '$mobileno'");
				$query = $database->fetchArray();
				if(empty($query))
				{
					header("Location: add_bene.php");
				}
				else{
					header("Location: list_bene.php");
				}
			}
		
		}
		
		if($_POST["submit"] == "add_bene")
		{
			$bene_name 		= trim($_POST["bene_name"]);
			$email  		= trim($_POST["email"]);
			$phone  		= trim($_POST["mobile_no"]);
			$bank_account 	= trim($_POST["bank_accno"]);
			$ifsc  			= trim($_POST["ifsccode"]);
			$address1  		= trim($_POST["address1"]);
			$city 			= trim($_POST["city"]);
			$state 			= trim($_POST["state"]);
			$pincode 		= trim($_POST["pincode"]);
			$bene_id        = uniqid(substr($bene_name,0,3),false);
			$user_mobno     = $_SESSION['mobileno'];
			
			
			/*$query = "INSERT INTO add_bene (bene_id, name, email, phone, bankaccount, ifsc, address1, city, state, pincode, user_mobno) 
			VALUES ('$bene_id','$bene_name', '$email', '$phone', '$bank_account', '$ifsc', '$address1', '$city', '$state', '$pincode', '$user_mobno');";
			$database->query($query);*/
			
			$curl = curl_init();

			  curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://payout-gamma.cashfree.com/payout/v1/authorize',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_HTTPHEADER => array(
				'X-Client-Id: CF96210C508DD41G1QB7Q3UQA9G',
				'X-Client-Secret: 356fd91d97c425cb919c41668dd2144ff3155ccc'
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			
			$get_response = json_decode($response);
			$get_auth_status = $get_response->status;
			$get_data = $get_response->data;
			$get_token = $get_data->token;
			
			if($get_auth_status == "SUCCESS")
			{
				
				$curl = curl_init();

			  curl_setopt_array($curl, array(
			  CURLOPT_URL => 'https://payout-gamma.cashfree.com/payout/v1/verifyToken',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_HTTPHEADER => array(
				'Authorization: Bearer '.$get_token),
			));

			$response = curl_exec($curl);

			curl_close($curl);
			
			$get_verify_response = json_decode($response);
			$get_verify_status = $get_verify_response->status;
			
				if($get_verify_status == "SUCCESS")
				{
					$postData = ["beneId" => $bene_id,
					"name" => $bene_name,
					"email" => $email,
					"phone" => $phone,
					"bankAccount" => $bank_account,
					"ifsc" => $ifsc,
					"address1" => $address1,
					"city" => $city,
					"state" => $state,
					"pincode" =>$pincode];
			
					$curl = curl_init();

					  curl_setopt_array($curl, array(
					  CURLOPT_URL => 'https://payout-gamma.cashfree.com/payout/v1/addBeneficiary',
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => '',
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => 'POST',
					  CURLOPT_POSTFIELDS =>json_encode($postData),
					  CURLOPT_HTTPHEADER => array(
						'Authorization: Bearer '.$get_token),
					));

					$response = curl_exec($curl);

					curl_close($curl);
					
					$get_response = json_decode($response);
					$get_bene_status = $get_response->status;
					$get_status_msg = $get_response->message;
					//echo $get_bene_status;
					//echo $get_status_msg;
					//exit;
					if($get_bene_status == "SUCCESS")
					{
						$query = "INSERT INTO add_bene (bene_id, name, email, phone, bankaccount, ifsc, address1, city, state, pincode, status, user_mobno) 
						VALUES ('$bene_id','$bene_name', '$email', '$phone', '$bank_account', '$ifsc', '$address1', '$city', '$state', '$pincode', '$get_bene_status','$user_mobno');";
						$database->query($query);
						
						header("Location: list_bene.php");
					}
					else{
						header("Location: add_bene.php?error=$get_status_msg");
					}
				}
			}

			
			
					
				}
			}
	
?>