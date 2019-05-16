<?php
	
	session_start();

	if(!isset($_SESSION['successregistration']))
	{
		header('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['successregistration']);
	}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>

    <div id="conteiner">
			
        <div id="blok3">

                <h1>UDANA REJESTRACJA</h1>

				<form action="index.php" method="post">
					<input id="Button1" type="submit" value="ZALOGUJ SIĘ" />
				</form>

        </div>
        

     

    </div>


</body>
</html>