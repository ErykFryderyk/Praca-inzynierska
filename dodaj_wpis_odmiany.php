<?php	
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
/*
    if (isset($_POST['insert_odmiany']))
    {
	$xml = new DomDocument("1.0","UTF-8");
	$xml -> load('odmiany.xml');
	
	$id_odmiany = $_POST['id_odmiany'];
	$nazwa_odmiany = $_POST['nazwa_odmiany'];
	$plon_odmiany = $_POST['plon_odmiany'];
    $zimnotrwalosc_odmiany = $_POST['zimnotrwalosc_odmiany'];
	$wczesnosc_odmiany = $_POST['wczesnosc_odmiany'];
	$odpczem_odmiany= $_POST['odpczem_odmiany'];
    $odpsuchazgn_odmiany = $_POST['odpsuchazgn_odmiany'];
    $odpzgntwardz_odmiany = $_POST['odpzgntwardz_odmiany'];
	
	$rootTag = $xml ->getElementsByTagName("xml")->item(0);
	
	$mainTag = $xml -> createElement("odmiany");
		$LpOdmianyTag = $xml ->createElement("LpOdmiany", $id_odmiany);
		$nazwaTag = $xml ->createElement("nazwa", $nazwa_odmiany);
		$plonTag = $xml ->createElement("plon", $plon_odmiany);
		$zimnotrwaloscTag = $xml ->createElement("zimotrwalosc", $zimnotrwalosc_odmiany);
		$wczesnoscTag = $xml ->createElement("wczesnosc", $wczesnosc_odmiany);
        $OdpCzemTag = $xml ->createElement("OdpCzem", $odpczem_odmiany);
        $OdpSuchaZgnTag = $xml ->createElement("OdpSuchaZgn", $odpsuchazgn_odmiany);
        $OdpZgnTwardzTag = $xml ->createElement("OdpZgnTwardz", $odpzgntwardz_odmiany);
		
		$mainTag ->appendChild($LpOdmianyTag);
		$mainTag ->appendChild($nazwaTag);
		$mainTag ->appendChild($plonTag);
		$mainTag ->appendChild($zimnotrwaloscTag);
		$mainTag ->appendChild($wczesnoscTag);
        $mainTag ->appendChild($OdpCzemTag);
        $mainTag ->appendChild($OdpSuchaZgnTag);
        $mainTag ->appendChild($OdpZgnTwardzTag);
		
	$rootTag ->appendChild($mainTag);
	$xml ->save('odmiany.xml');
}
*/
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

           <h2 style="color:#58BAB5; text-align:center; padding:5px;">Dodawanie wpisu w kategorii Odmiana rzepaku</h2><br><br>
         
	        <form method="POST" action = "odmiany.php">
        Numer wpisu:<br/> 
            <input type="text" name = "id_odmiany" readonly value="<?php echo $_SESSION["odmiany"];?>"><br/>
        Nazwa:<br/> 
            <input type = "text" name = "nazwa_odmiany" > <br/>
        Plon:<br/> 
            <input type = "text" name = "plon_odmiany" > <br/>
        Zimnotrwałość:<br/> 
            <input type = "text" name = "zimnotrwalosc_odmiany" > <br/>
        Wczesność:<br/> 
            <input type = "text" name = "wczesnosc_odmiany" > <br/>
        Odporność na czerń krzyżowych:<br/> 
            <input type = "text" name = "odpczem_odmiany" > <br/>
        Odporność na suchą zgniliznę kapustnych:<br/> 
            <input type = "text" name = "odpsuchazgn_odmiany" > <br/>
        Odporność na zgniliznę twardzikową:<br/> 
            <input type = "text" name = "odpzgntwardz_odmiany" > <br/>

		<input type="submit" name="insert_odmiany" value="DODAJ WPIS">

	    </form>

    <br/>
    <br/>
			
		</div>
	</div>

</body>
</html>