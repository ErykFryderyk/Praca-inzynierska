<?php
	
	session_start();

	if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']== true))
	{
		header('Location: main_page.php');
		exit();
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
			
        <div id="blok1">

            <div id="rejestracja">
				
					<h3>Uniwersytet Przyrodniczy <br> w Poznaniu</h3>

					<h4>Wydzial Rolnictwa i Biosystemów</h4>

					Aplikacja została wykonana <br>w ramach pracy inżynierskiej:<br/><br>
					"Projekt i implementacja aplikacji internetowej wspomagającej zarządzanie danymi z sektora rolniczego zapisanymi w tekstowych formatach wymiany danych"
                    <br/>
                    <br/>
                    <br/>
                    <br/>
   					<form action="registration.php" method="post">
						<input id="Button1" type="submit" value="REJESTRACJA" />
					</form>
            </div>

        </div>
        
        <div id="blok2">
			<img src="img/logo.png" style="width:270px; height:150px;"/>

				<div id="password">
					
					<form action="login.php" method="post">
						<h4>Wprowadź login i hasło: </h4>
						<input id="login" style="" type="text" name="login" placeholder="login" onfocus="this.placeholder=' '" onblur="this.placeholder='login'"/>
							<br />
						<input id="haslo" type="password" name="password" placeholder="hasło" onfocus="this.placeholder=' '" onblur="this.placeholder='hasło'" />
							<br />
						<input id="Button2" type="submit" value="ZALOGUJ" style="margin-left:60px;"/>
							<br />
					</form>
					<br/>
						<?php
							if(isset($_SESSION['blad']))   echo $_SESSION['blad'];
						?>
				</div>
        </div>
        <div style="clear:both"></div>
     

    </div>


</body>
</html>