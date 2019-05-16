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
            $dom->load("szkodniki.xml"); 
            $xpath = new DomXPath($dom);
            $nodes = $xpath->query('szkodniki/LpSzk'); 
  
    for ($i = 0; $i < $nodes->length; $i++) 
    {     
        $node = $nodes->item($i);
            if ($node->nodeValue == $id_tag) 
            {
                $node->parentNode->parentNode->removeChild($node->parentNode);
            }         
    }
    $dom->save('szkodniki.xml'); 
    }
	//Dodawanie wpisu 
    if (isset($_POST['insert_szkodniki']))
    {
	$xml = new DomDocument("1.0","UTF-8");
	$xml -> load('szkodniki.xml');
	
	$LpSzk_szkodniki = $_POST['LpSzk_szkodniki'];
	$nazwa_szkodniki = $_POST['nazwa_szkodniki'];
	$nazwaLat = $_POST['nazwaLat'];
    $nazwaAng = $_POST['nazwaAng'];
	$systematyka = $_POST['systematyka'];
	$BudDorosly= $_POST['BudDorosly'];
    $BudMlody = $_POST['BudMlody'];
    $BudJajo = $_POST['BudJajo'];
    $BudPoczwarka = $_POST['BudPoczwarka'];
    $UszkLisci = $_POST['UszkLisci'];
    $UszkLodyg = $_POST['UszkLodyg'];
    $UszkLuszczyn = $_POST['UszkLuszczyn'];
    $UszkPakow = $_POST['UszkPakow'];
    $UszkKorzeni = $_POST['UszkKorzeni'];
    $TerminUszkM = $_POST['TerminUszkM'];
    $TerminUszkF = $_POST['TerminUszkF'];
    $MetodyObs = $_POST['MetodyObs'];
    $Progi = $_POST['Progi'];
    $MetodyOchr = $_POST['MetodyOchr'];
    $Zdjecia = $_POST['Zdjecia'];
	
	$rootTag = $xml ->getElementsByTagName("xml")->item(0);
	
	$mainTag = $xml -> createElement("szkodniki");
		$LpSzkTag = $xml ->createElement("LpSzk", $LpSzk_szkodniki);
		$nazwaTag = $xml ->createElement("nazwa", $nazwa_szkodniki);
        $nazwaLatTag = $xml ->createElement("nazwaLat", $nazwaLat);
		$nazwaAngTag = $xml ->createElement("nazwaAng", $nazwaAng);
		$systematykaTag = $xml ->createElement("systematyka", $systematyka);
		$BudDorolyTag = $xml ->createElement("BudDorosly", $BudDorosly);
        $BudMlodyTag = $xml ->createElement("BudMlody", $BudMlody);
        $BudJajoTag = $xml ->createElement("BudJajo", $BudJajo);
        $BudPoczwarkaTag = $xml ->createElement("BudPoczwarka", $BudPoczwarka);
        $UszkLisciTag = $xml ->createElement("UszkLisci", $UszkLisci);
        $UszkLodygTag = $xml ->createElement("UszkLodyg", $UszkLodyg);
        $UszkLuszczynTag = $xml ->createElement("UszkLuszczyn", $UszkLuszczyn);
        $UszkPakowTag = $xml ->createElement("UszkPakow", $UszkPakow);
        $UszkKorzeniTag = $xml ->createElement("UszkKorzeni", $UszkKorzeni);
        $TerminUszkMTag = $xml ->createElement("TerminUszkM", $TerminUszkM);
        $TerminUszkFTag = $xml ->createElement("TerminUszkF", $TerminUszkF);
        $MetodyObsTag = $xml ->createElement("MetodyObs", $MetodyObs);
        $ProgiTag = $xml ->createElement("Progi", $Progi);
        $MetodyOchrTag = $xml ->createElement("MetodyOchr", $MetodyOchr);
        $ZdjeciaTag = $xml ->createElement("Zdjecia", $Zdjecia);
		
		$mainTag ->appendChild($LpSzkTag);
		$mainTag ->appendChild($nazwaTag);
		$mainTag ->appendChild($nazwaLatTag);
		$mainTag ->appendChild($nazwaAngTag);
		$mainTag ->appendChild($systematykaTag);
        $mainTag ->appendChild($BudDorolyTag);
        $mainTag ->appendChild($BudMlodyTag);
        $mainTag ->appendChild($BudJajoTag);
        $mainTag ->appendChild($BudPoczwarkaTag);
        $mainTag ->appendChild($UszkLisciTag);
        $mainTag ->appendChild($UszkLodygTag);
        $mainTag ->appendChild($UszkLuszczynTag);
        $mainTag ->appendChild($UszkPakowTag);
        $mainTag ->appendChild($UszkKorzeniTag);
        $mainTag ->appendChild($TerminUszkMTag);
        $mainTag ->appendChild($TerminUszkFTag);
        $mainTag ->appendChild($MetodyObsTag);
        $mainTag ->appendChild($ProgiTag);
        $mainTag ->appendChild($MetodyOchrTag);
        $mainTag ->appendChild($ZdjeciaTag);
		
	$rootTag ->appendChild($mainTag);
	$xml ->save('szkodniki.xml');
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
            <h1 style="color: Highlight; text-align:center; padding:5px;">SZKODNIKI</h1>
		</div>

	
		<div id="aktualnosci">
			    
            <?php


            $xml = simplexml_load_file("szkodniki.xml");

            foreach($xml -> szkodniki as $show)
                {
                    echo '<div class="tresc">';
                        echo "<b>Numer wpisu: </b>";
                        echo $show -> LpSzk."<br/>";

                        echo "<b>Nazwa: </b>";
                        echo $show -> nazwa."<br/>";

                        echo "<b>Nazwa Łacińska: </b>";
                        echo $show -> nazwaLat."<br/>";

                        echo "<b>Nazwa Angielska: </b>";
                        echo $show -> nazwaAng."<br/>";

                        echo "<b>Systematyka: </b>";
                        echo $show -> systematyka."<br/>";

                        echo "<b>Budowa dorosłego osobnika: </b>";
                        echo $show -> BudDorosly."<br/>";

                        echo "<b>Budowa młodego osobnika: </b>";
                        echo $show -> BudMlody."<br/>";

                        echo "<b>Budowa jajka: </b>";
                        echo $show -> BudJajo."<br/>";

                        echo "<b>Budowa poczwarki: </b>";
                        echo $show -> BudPoczwarka."<br/>";

                        echo "<b>Uszkodzenia liści: </b>";
                        echo $show -> UszkLisci."<br/>";

                        echo "<b>Uszkodzenia łodyg: </b>";
                        echo $show -> UszkLodyg."<br/>";

                        echo "<b>Uszkodzenia łuszczyn: </b>";
                        echo $show -> UszkLuszczyn."<br/>";

                        echo "<b>Uszkodzenia pąków: </b>";
                        echo $show -> UszkPakow."<br/>";

                        echo "<b>Uszkodzenia korzeni: </b>";
                        echo $show -> UszkKorzeni."<br/>";

                        echo "<b>Termin uszkodzenia M: </b>";
                        echo $show -> TerminUszkM."<br/>";

                        echo "<b>Termin uszkodzenia F: </b>";
                        echo $show -> TerminUszkF."<br/>";

                        echo "<b>Metody obserwacji: </b>";
                        echo $show -> MetodyObs."<br/>";

                        echo "<b>Progi: </b>";
                        echo $show -> Progi."<br/>";

                        echo "<b>Metodu ochrony: </b>";
                        echo $show -> MetodyOchr."<br/>";

                        echo "<b>Zdjęcia: </b>";
                        echo $show -> Zdjecia."<br/>";

                    echo '</div>';
                    ?>
                        <form method="post" action="dodaj_wpis_szkodniki.php">
                            <input type="submit" value="Dodaj wpis" style="float:left; margin-top:6px; margin-left:10px;" />
                        </form>
                        <form action="" method="post"> 
                            <input type="text" style="width:0px; border: none; background: transparent;" name="first_tag"  readonly value="<?php echo $show -> LpSzk?>" >
                            <input type="submit" name="delete" value="Usuń wpis">
                        </form>
                        <br/><br/>
            <?php
                            $nr_szkodniki = $show->LpSzk + 1 ;
                            $_SESSION["szkodniki"] = $nr_szkodniki;  
                }

            ?>

		</div>
	</div>
</body>
</html>