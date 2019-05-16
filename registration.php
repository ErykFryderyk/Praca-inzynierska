<?php

	session_start();
	
	if (isset($_POST['email']))
	{
		$wszystko_OK=true;
		
		$nick = $_POST['nick'];
		
		if ((strlen($nick)<3) || (strlen($nick)>20))
		{
			$wszystko_OK=false;
			$_SESSION['error_nick']= "Nazwa musi mieć od 3 do 20 znaków!";
		}	
		
		if (ctype_alnum($nick)==false)
		{
			$wszystko_OK=false;
			$_SESSION['error_nick']= "Nazwa musi składać się tylko z liter i cyfr (bezpolskich znaków)";
		}
		//sprawdzanie poprawności emaila
		$email = $_POST['email'];
		$emailG = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailG, FILTER_SANITIZE_EMAIL)==false) || ($emailG!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['error_email'] = "Podaj poprawny adres e-mail";
			
		}
		//sprawdzanie hasła 
		$haslo1=$_POST['haslo1'];
		$haslo2=$_POST['haslo2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['error_haslo']= "Hasło musi mieć od 8 do 20 znaków!";
		}	
		
		if($haslo1!=$haslo2)
		{
		$wszystko_OK=false;
			$_SESSION['error_haslo']= "Hasła nie są identyczne";
		}	
		//hashowanie hasla
		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		
		require_once "connect.php";
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if($connection->connect_errno!=0)
			{
		
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				//Sprawdzanie emaila czy juz jest 
				$result = $connection->query("SELECT id FROM uzytkownicy WHERE email='$email'");
				
				if(!$result) throw new Exception($connection->error);
				
				$ile_emaili = $result->num_rows;
				if ($ile_emaili>0)
				{
					$wszystko_OK=false;
					$_SESSION['error_email']= "Istnieje juz konto do tego konta e-mail";
				}
				//Sprawdzanie nazwy czy juz jest 
				$result = $connection->query("SELECT id FROM uzytkownicy WHERE user='$nick'");
				
				if(!$result) throw new Exception($connection->error);
				
				$ile_nickow = $result->num_rows;
				if ($ile_nickow>0)
				{
					$wszystko_OK=false;
					$_SESSION['error_nick']= "Nazwa zajęta";
				}
				if ($wszystko_OK==true)
				{ 
					// wszystko git
					if ($connection->query("INSERT INTO uzytkownicy VALUES (NULL, '$nick', '$haslo_hash', '$email')"))
					{
						$_SESSION['successregistration']=true;
						header('Location: successregistration.php');
					}
					
				}
				$connection->close();
				

			}
			
		}
		catch(Exception $e)
		{
			echo "Błąd serwera!"; //echo $e;
		}
	}
?>

<!DOCTYPE HTML>
<html land ="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-AU-Compatible" content="IE=edge,chrome=1"/>
	<title> </title>
	
	<link rel="stylesheet" href="style.css" type="text/css" />
	
</head>

<body>

	<div id="blok3">

	<h1>REJESTRACJA</h1>
		<form method="post">
		
		Nazwa:<br /> <input type="text" name="nick" /> 
		<br />
		<?php
			if (isset($_SESSION['error_nick']))
			{
				echo "<div class = 'error'>".$_SESSION['error_nick']."</div>";
				unset($_SESSION['error_nick']);
			}
		?>
		
		E-mail:<br /> <input type="text" name="email" /> <br />
		<?php
			if (isset($_SESSION['error_email']))
			{
				echo "<div class = 'error'>".$_SESSION['error_email']."</div>";
				unset($_SESSION['error_email']);
			}
		
		?>
		Hasło:<br /> <input  type="password" name="haslo1" /> <br />
		
		<?php
			if (isset($_SESSION['error_haslo']))
			{
				echo "<div class = 'error'>".$_SESSION['error_haslo']."</div>";
				unset($_SESSION['error_haslo']);
			}
		
		?>
		
		Powtórz hasło:<br /> <input type="password" name="haslo2" /> <br />
		
		<input id="Button1" type="submit" value="ZAREJESTRUJ SIĘ" />
		
		</form>
		<br/>
        <form action="index.php" method="post">
        <input id="Button1" type="submit" value="WRÓĆ" />
        </form>

	</div>
</body>

</html>