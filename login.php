<?php
	
	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php";
	
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
	else
	{
	
		$login=$_POST['login'];
		$password=$_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	
		
		if ($result = @$connection->query(sprintf("SELECT * FROM uzytkownicy WHERE user='%s'",
		mysqli_real_escape_string($connection,$login))))
		{
			$ile_users = $result->num_rows;
			if($ile_users>0)
			{
				$verse = $result->fetch_assoc();
				
				if(password_verify($password,$verse['pass']))
				{
					
					$_SESSION['zalogowany']=true;
					$_SESSION['user'] = $verse['user'];
					
					unset($_SESSION['blad']);
					$result->free_result();
					header('Location: odmiany.php');
				}
				else
				{
					$_SESSION['blad'] = '<span style = "color:red"> Złe hasło lub login! </span>';
					header('Location: index.php');
				}
			}
			else
			{
				$_SESSION['blad'] = '<span style = "color:red"> Złe hasło lub login! </span>';
				header('Location: index.php');
			}
			
		}
		
		$connection->close();
	}
?>








