<?php
	
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
    // Usuwanie wpisu 
    if (isset($_POST['delete']))

    {
            $LpSrodkiTag = $_POST['first_tag'];
            $dom = new DomDocument(); 
            $dom->load("srodki_ochrony.xml"); 
            $xpath = new DomXPath($dom);
            $nodes = $xpath->query('srodkiOchrony/LpSrodki'); 
  
    for ($i = 0; $i < $nodes->length; $i++) 
    {     
        $node = $nodes->item($i);
            if ($node->nodeValue == $LpSrodkiTag) 
            {
                $node->parentNode->parentNode->removeChild($node->parentNode);
            }         
    }
    $dom->save('srodki_ochrony.xml'); 
    }
    // Dodawanie nowego wpisu
    if (isset($_POST['insert_ochrony']))
    {
	$xml = new DomDocument("1.0","UTF-8");
	$xml -> load('srodki_ochrony.xml');
	
	$LpSrodki = $_POST['LpSrodki'];
	$nazwa = $_POST['nazwa'];
	$rodzaj = $_POST['rodzaj'];
    $SubstAktywne = $_POST['SubstAktywne'];
	$zawartosci = $_POST['zawartosci'];
	$toksycznosc  = $_POST['toksycznosc'];
    $optTemp = $_POST['optTemp'];
    $karencja = $_POST['karencja'];
    $prewencja = $_POST['prewencja'];
	
	$rootTag = $xml ->getElementsByTagName("xml")->item(0);
	
	$mainTag = $xml -> createElement("srodkiOchrony");
		$LpSrodkiTag = $xml ->createElement("LpSrodki", $LpSrodki);
		$nazwaTag = $xml ->createElement("nazwa", $nazwa);
		$rodzajTag = $xml ->createElement("rodzaj", $rodzaj);
		$SubstAktywneTag = $xml ->createElement("SubstAktywne", $SubstAktywne);
		$zawartosciTag = $xml ->createElement("zawartosci", $zawartosci);
        $toksycznoscTag = $xml ->createElement("toksycznosc", $toksycznosc);
        $optTempTag = $xml ->createElement("optTemp", $optTemp);
        $karencjaTag = $xml ->createElement("karencja", $karencja);
        $prewencjaTag = $xml ->createElement("prewencja", $prewencja);
		
		$mainTag ->appendChild($LpSrodkiTag);
		$mainTag ->appendChild($nazwaTag);
		$mainTag ->appendChild($rodzajTag);
		$mainTag ->appendChild($SubstAktywneTag);
		$mainTag ->appendChild($zawartosciTag);
        $mainTag ->appendChild($toksycznoscTag);
        $mainTag ->appendChild($optTempTag);
        $mainTag ->appendChild($karencjaTag);
        $mainTag ->appendChild($prewencjaTag);
		
	$rootTag ->appendChild($mainTag);
	$xml ->save('srodki_ochrony.xml');
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
            <h1 style="color: Highlight; text-align:center; padding:5px;">ŚRODKI OCHRONY</h1>
		</div>

	
		<div id="aktualnosci">
			    
            <?php


                $xml = simplexml_load_file("srodki_ochrony.xml");

                foreach($xml -> srodkiOchrony as $show)
                {
                    echo '<div class="tresc">';
                        echo "<b>Numer wpisu: </b>";
                        echo $show -> LpSrodki."<br/>";
                        echo "<b>Nazwa: </b>";
                        echo $show -> nazwa."<br/>";
                        echo "<b>Rodzaj: </b>";
                        echo $show -> rodzaj."<br/>";
                        echo "<b>Substancje aktywne: </b>";
                        echo $show -> SubstAktywne. "<br/>";
                        echo "<b>Zawartość: </b>";
                        echo $show -> zawartosci -> zawartosc[0].', '. $show -> zawartosci -> zawartosc[1]. "<br/>";
                        echo "<b>Toksyczność: </b>";
                        echo $show -> toksycznosc."<br/>";
                        echo "<b>Optymalna temperatura: </b>";
                        echo $show -> optTemp."<br/>";
                        echo "<b>Karencja: </b>";
                        echo $show -> karencja."<br/>";
                        echo "<b>Prewencja: </b>";
                        echo $show -> prewencja."<br/>";
                        echo '</div>';
                        
                    ?>
                        <form method="post" action="dodaj_wpis_srodki_ochrony.php">
                            <input type="submit" value="Dodaj wpis" style="float:left; margin-top:6px; margin-left:10px;" />
                        </form>
                        <form action="" method="post"> 
                        <input type="text" style="width:0px; border: none; background: transparent;" name="first_tag"  readonly value="<?php echo $show -> LpSrodki?>" >
                        <input type="submit" name="delete" value="Usuń wpis">
                        </form>
                        <br/><br/>
            <?php
                $nr_ochrony = $show->LpSrodki + 1 ;
                $_SESSION["ochrony"] = $nr_ochrony;
                }

            ?>
			
		</div>
	</div>
</body>
</html>