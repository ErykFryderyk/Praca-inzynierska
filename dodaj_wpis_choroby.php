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

           <h2 style="color:#58BAB5; text-align:center; padding:5px;">Dodawanie wpisu w kategorii Choroba</h2><br><br>

	        <form method="POST" action = "choroby.php">
        Numer wpisu:<br/> 
            <input type="text" name = "LpCh" readonly value="<?php echo $_SESSION["choroby"];?>"><br/>
        Nazwa:<br/> 
            <input type = "text" name = "nazwa_choroby" > <br/>
        Nazwa Łacińska:<br/> 
            <input type = "text" name = "nazwaLat_choroby" > <br/>
        Nazwa Angielska:<br/> 
            <input type = "text" name = "nazwaAng_choroby" > <br/>
        Szkodliwość:<br/> 
            <textarea type = "text" name = "szkodliwosc" ></textarea> <br/>
        Termin uszm:<br/> 
            <input type = "text" name = "terminuszm" > <br/>
        Termin usz:<br/> 
            <input type = "text" name = "terminusz" > <br/>
        Progi:<br/> 
            <input type = "text" name = "progi" > <br/>
        Metody ochrony:<br/> 
            <input type = "text" name = "metodyOchr" > <br/>
        Zdjęcia:<br/> 
            <input type = "text" name = "zdjecia" > <br/>

		<input type="submit" name="insert_choroby" value="DODAJ WPIS">

	</form>
    <br/>
    <br/>
			
		</div>
	</div>

</body>
</html>