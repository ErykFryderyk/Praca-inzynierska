<?php
	
	session_start();
   
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
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
    
    <div id="menu">

        <a href="odmiany.php">ODMIANY RZEPAKU</a>
        <a href="szkodniki.php">SZKODNIKI</a>
        <a href="zaprawy.php">ZAPRAWY</a>
        <a href="choroby.php">CHOROBY</a>
        <a href="srodki_ochrony.php">ŚRODKI OCHRONY</a>
        <a href="logout.php" style="color:green; font-weight:bold;">WYLOGUJ</a>
        <div style="clear:both;"></div>
    </div>
    
	<div id="container1">

        <div id="dodawanie_wpisu">

           <h2 style="color:#58BAB5; text-align:center; padding:5px;">Dodawanie wpisu w kategorii Zaprawa</h2><br><br>

	        <form method="POST" action = "zaprawy.php">
        Numer wpisu:<br/> 
            <input type="text" name = "id_zaprawy"  
            readonly value="
            <?php 
                echo $_SESSION["zaprawy"];
            ?>
            "><br/>
        Nazwa:<br/> 
            <input type = "text" name = "nazwa_zaprawy" > <br/>
        Rodzaj:<br/> 
            <input type = "text" name = "rodzaj_zaprawy" > <br/>
        Substancje aktywne:<br/> 
            <input type = "text" name = "sub_aktywne_zaprawy" > <br/>
        Zawartość:<br/> 
            <input type = "text" name = "zawartosc_zaprawy" > <br/>
        Toksyczność:<br/> 
            <input type = "text" name = "toksycznosc_zaprawy" > <br/>

		<input type="submit" name="insert_zaprawy" value="DODAJ WPIS">

	</form>
    <br/>
    <br/>
			
		</div>
	</div>

</body>
</html>