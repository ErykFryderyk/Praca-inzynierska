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

           <h2 style="color:#58BAB5; text-align:center; padding:5px;">Dodawanie wpisu w kategorii Szkodnik</h2><br><br>

	        <form method="POST" action = "szkodniki.php">
        Numer wpisu:<br/> 
            <input type="text" name = "LpSzk_szkodniki" readonly value="<?php echo $_SESSION["szkodniki"];?>"><br/>
        Nazwa:<br/> 
            <input type = "text" name = "nazwa_szkodniki" > <br/>
        Nazwa Łacińska:<br/> 
            <input type = "text" name = "nazwaLat" > <br/>
        Nazwa Angielska:<br/> 
            <input type = "text" name = "nazwaAng" > <br/>
        Systematyka:<br/> 
            <input type = "text" name = "systematyka" > <br/>
        Budowa dorosłego osobnika:<br/> 
            <textarea type="text"name = "BudDorosly"></textarea> <br/>
        Budowa młodego osobnika:<br/> 
            <textarea type = "text" name = "BudMlody" ></textarea> <br/>
        Budowa jaja:<br/> 
            <input type = "text" name = "BudJajo" > <br/>
        Budowa poczwarki:<br/> 
            <textarea type = "text" name = "BudPoczwarka" ></textarea> <br/>
        Uszkodzenia liści:<br/> 
            <textarea type = "text" name = "UszkLisci" ></textarea> <br/>
        Uszkodzenia łodyg:<br/> 
            <textarea type = "text" name = "UszkLodyg" ></textarea> <br/>
        Uszkodzenia łuszczyn:<br/> 
            <textarea type = "text" name = "UszkLuszczyn" ></textarea> <br/>
        Uszkodzenia pąków:<br/> 
            <textarea type = "text" name = "UszkPakow" ></textarea> <br/>
        Uszkodzenia korzeni:<br/> 
            <textarea type = "text" name = "UszkKorzeni" ></textarea> <br/>
        Termin uszkodzenia M:<br/> 
            <input type = "text" name = "TerminUszkM" > <br/>
        Termin uszkodzenia F:<br/> 
            <input type = "text" name = "TerminUszkF" > <br/>
        Metody Obserwacji:<br/> 
            <textarea type = "text" name = "MetodyObs" ></textarea> <br/>
        Progi:<br/> 
            <input type = "text" name = "Progi" > <br/>
        Metody ochrony:<br/> 
            <textarea type = "text" name = "MetodyOchr" ></textarea> <br/>
        Zdjęcia:<br/> 
            <input type = "text" name = "Zdjecia" > <br/>

		<input type="submit" name="insert_szkodniki" value="DODAJ WPIS">

	</form>
    <br/>
    <br/>
			
		</div>
	</div>
   

</body>
</html>