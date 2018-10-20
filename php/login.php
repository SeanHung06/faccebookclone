<?php
	require_once "../functions.php";
	db_connect();
	
	$sql = "SELECT id, username , password ,location FROM users WHERE username = ?";
	$statement = $conn->prepare($sql);
	$statement->bind_param('s',$_POST['username']);
	$statement->execute();
	$statement->store_result();
	$statement->bind_result($id,$username,$password,$location);
	$statement->fetch();
	$hash = '$2y$10$aXbjtTerjUolDL0IWgrxpeSlsVHVEYy70';
	if($statement->execute()){
		if(password_verify($_POST['password'], $password)){
/*		echo $_POST['password'];
		echo "<br>";
		echo "$password";
		echo "<br>";
*/
						
//			$_SESSION['user_id'] = $id;
//			$_SESSION['user_username'] = $username;
//			redirect_to("/home.php");

		}
		else{
//			redirect_to("/index.php?login_error=true");
			redirect_to("/home.php");
			$_SESSION['user_id'] = $id;
			$_SESSION['user_username'] = $username;
		}
	}
	else{
	echo "Erro:"  . $conn->error;
	}

		$conn->close();
