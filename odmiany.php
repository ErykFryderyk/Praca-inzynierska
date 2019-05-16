<?php
	
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
    //Usuwanie wpisu
    if (isset($_POST['delete']))

    {
            $id_tag = $_POST['first_tag'];
            $dom = new DomDocument(); 
            $dom->load("odmiany.xml"); 
            $xpath = new DomXPath($dom);
            $nodes = $xpath->query('odmiany/LpOdmiany'); 
  
    for ($i = 0; $i < $nodes->length; $i++) 
    {     
        $node = $nodes->item($i);
            if ($node->nodeValue == $id_tag) 
            {
                $node->parentNode->parentNode->removeChild($node->parentNode);
            }         
    }
    $dom->save('odmiany.xml'); 
    }
    
    //Dodawanie wpisu
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

		<div class="border">
            <h1 style="color: Highlight; text-align:center; padding:5px;">ODMIANY RZEPAKU</h1>
		</div>

	
		<div id="aktualnosci">
			    
            <?php


                $xml = simplexml_load_file("odmiany.xml");

                foreach($xml -> odmiany as $show)
                {
                    echo '<div class="tresc">';
                        echo "<b>Numer wpisu: </b>";
                        echo $show -> LpOdmiany."<br/>";
                        echo "<b>Nazwa: </b>";
                        echo $show -> nazwa."<br/>";
                        echo "<b>Plon: </b>";
                        echo $show -> plon."<br/>";
                        echo "<b>Zimnotrwałość: </b>";
                        echo $show -> zimotrwalosc."<br/>";
                        echo "<b>Wczesność: </b>";
                        echo $show -> wczesnosc."<br/>";
                        echo "<b>Odporność na czerń krzyżowych: </b>";
                        echo $show -> OdpCzem. "<br/>";
                        echo "<b>Odporność na suchą zgniliznę kapustnych: </b>";
                        echo $show -> OdpSuchaZgn."<br/>";
                        echo "<b>Odporność na zgniliznę twardzikową: </b>";
                        echo $show -> OdpZgnTwardz."<br/>";
                    echo '</div>';
                    
                     ?>
                        <form method="post" action="dodaj_wpis_odmiany.php">
                                <input type="submit" value="Dodaj wpis" style="float:left; margin-top:6px; margin-left:10px;" />
                        </form>
                    
                        <form action="" method="post">
                            <input type="text" style="width:0px; border: none; background: transparent;" name="first_tag"  readonly value="<?php echo $show -> LpOdmiany ?>" >
                            <input type="submit" name="delete" value="Usuń wpis">
                        </form>
                    <br/><br/>
            <?php
                }
                $nr_odmiany = $show->LpOdmiany + 1 ;
                $_SESSION["odmiany"] = $nr_odmiany;
            ?>
			
		</div>
	</div>
</body>
</html>