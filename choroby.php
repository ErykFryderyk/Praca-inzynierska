<?php
	
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
    //Usuwanie wpisu
    if (isset($_POST['submit']))

    {
            $LpChTag = $_POST['LpChTag'];
            $dom = new DomDocument(); 
            $dom->load("choroby.xml"); 
            $xpath = new DomXPath($dom);
            $nodes = $xpath->query('choroby/LpCh'); 
  
    for ($i = 0; $i < $nodes->length; $i++) 
    {     
        $node = $nodes->item($i);
            if ($node->nodeValue == $LpChTag) 
            {
                $node->parentNode->parentNode->removeChild($node->parentNode);
            }         
    }
    $dom->save('choroby.xml'); 
    }
    // Dodawanie wpisu
    if (isset($_POST['insert_choroby']))
    {
	$xml = new DomDocument("1.0","UTF-8");
	$xml -> load('choroby.xml');
	
	$LpCh = $_POST['LpCh'];
	$nazwa_choroby = $_POST['nazwa_choroby'];
	$nazwaLat_choroby = $_POST['nazwaLat_choroby'];
    $nazwaAng_choroby = $_POST['nazwaAng_choroby'];
	$szkodliwosc = $_POST['szkodliwosc'];
	$terminuszm= $_POST['terminuszm'];
    $terminusz = $_POST['terminusz'];
    $progi = $_POST['progi'];
    $metodyOchr = $_POST['metodyOchr'];
    $zdjecia = $_POST['zdjecia'];
	
	$rootTag = $xml ->getElementsByTagName("xml")->item(0);
	
	$mainTag = $xml -> createElement("choroby");
		$LpChTag = $xml ->createElement("LpCh", $LpCh);
		$nazwa_ochronyTag = $xml ->createElement("nazwa", $nazwa_choroby);
		$nazwaLat_chorobyTag = $xml ->createElement("nazwaLat", $nazwaLat_choroby);
		$nazwaAng_chorobyTag = $xml ->createElement("nazwaAng", $nazwaAng_choroby);
		$szkodliwoscTag = $xml ->createElement("szkodliwosc", $szkodliwosc);
        $terminuszmTag = $xml ->createElement("terminuszm", $terminuszm);
        $terminuszTag = $xml ->createElement("terminusz", $terminusz);
        $progiTag = $xml ->createElement("progi", $progi);
        $metodyOchrTag = $xml ->createElement("metodyOchr", $metodyOchr);
        $zdjeciaTag = $xml ->createElement("zdjecia", $zdjecia);
		
		$mainTag ->appendChild($LpChTag);
		$mainTag ->appendChild($nazwa_ochronyTag);
		$mainTag ->appendChild($nazwaLat_chorobyTag);
		$mainTag ->appendChild($nazwaAng_chorobyTag);
		$mainTag ->appendChild($szkodliwoscTag);
        $mainTag ->appendChild($terminuszmTag);
        $mainTag ->appendChild($terminuszTag);
        $mainTag ->appendChild($progiTag);
        $mainTag ->appendChild($metodyOchrTag);
        $mainTag ->appendChild($zdjeciaTag);
		
	$rootTag ->appendChild($mainTag);
	$xml ->save('choroby.xml');
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
            <h1 style="color: Highlight; text-align:center; padding:5px;">CHOROBY</h1>
		</div>

	
		<div id="aktualnosci">
			    
            <?php


                $xml = simplexml_load_file("choroby.xml");

                foreach($xml -> choroby as $show)
                {
                    echo '<div class="tresc">';
                        echo "<b>Numer wpisu: </b>";
                        echo $show -> LpCh."<br/>";
                        echo "<b>Nazwa: </b>";
                        echo $show -> nazwa."<br/>";
                        echo "<b>Nazwa Łacińska: </b>";
                        echo $show -> nazwaLat."<br/>";
                        echo "<b>Nazwa Angielska: </b>";
                        echo $show -> nazwaAng."<br/>";
                        echo "<b>Szkodliwość: </b>";
                        echo $show -> szkodliwosc."<br/>";
                        echo "<b>Termin uszm: </b>";
                        echo $show -> terminuszm."<br/>";
                        echo "<b>Termin usz: </b>";
                        echo $show -> terminusz."<br/>";
                        echo "<b>Progi: </b>";
                        echo $show -> progi."<br/>";
                        echo "<b>Metody ochrony: </b>";
                        echo $show -> metodyOchr. "<br/>";
                        echo "<b>Zdjęcia: </b>";
                        echo $show -> zdjecia."<br/>";
                    echo '</div>';
                    ?>
                        <form method="post" action="dodaj_wpis_choroby.php">
                                <input type="submit" value="Dodaj wpis" style="float:left; margin-top:6px; margin-left:10px;" />
                        </form>
                        <form action="" method="post"> 
                            <input type="text" name="LpChTag" style="width:0px; border:none; background: transparent; "  readonly value="<?php echo $show -> LpCh?>" >
                            <input type="submit" name="submit" value="Usuń wpis">
                        </form>
                        <br/><br/>
                    <?php
                $nr_choroby = $show->LpCh + 1 ;
                $_SESSION["choroby"] = $nr_choroby;
                }

            ?>
			
		</div>
	</div>
</body>
</html>