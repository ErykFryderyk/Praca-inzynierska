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
            $dom->load("zaprawy.xml"); 
            $xpath = new DomXPath($dom);
            $nodes = $xpath->query('zaprawy/id'); 
  
    for ($i = 0; $i < $nodes->length; $i++) 
    {     
        $node = $nodes->item($i);
            if ($node->nodeValue == $id_tag) 
            {
                $node->parentNode->parentNode->removeChild($node->parentNode);
            }         
    }
    $dom->save('zaprawy.xml'); 
    }
    
    //Dodawanie nowego wpisu
    if (isset($_POST['insert_zaprawy']))
    {
	$xml = new DomDocument("1.0","UTF-8");
	$xml -> load('zaprawy.xml');
	
	$id_zaprawy = $_POST['id_zaprawy'];
	$nazwa_zaprawy = $_POST['nazwa_zaprawy'];
	$rodzaj_zaprawy = $_POST['rodzaj_zaprawy'];
	$sub_aktywne_zaprawy = $_POST['sub_aktywne_zaprawy'];
	$zawartosc_zaprawy = $_POST['zawartosc_zaprawy'];
    $toksycznosc_zaprawy = $_POST['toksycznosc_zaprawy'];
	
	$rootTag = $xml ->getElementsByTagName("xml")->item(0);
	
	$mainTag = $xml -> createElement("zaprawy");
		$idTag = $xml ->createElement("id", $id_zaprawy);
		$nazwaTag = $xml ->createElement("nazwa", $nazwa_zaprawy);
		$rodzajTag = $xml ->createElement("rodzaj", $rodzaj_zaprawy);
		$substAktywneTag = $xml ->createElement("substAktywne", $sub_aktywne_zaprawy);
		$zawartosciTag = $xml ->createElement("zawartosci", $zawartosc_zaprawy);
        $toksycznoscTag = $xml ->createElement("toksycznosc", $toksycznosc_zaprawy);
		
		$mainTag ->appendChild($idTag);
		$mainTag ->appendChild($nazwaTag);
		$mainTag ->appendChild($rodzajTag);
		$mainTag ->appendChild($substAktywneTag);
		$mainTag ->appendChild($zawartosciTag);
        $mainTag ->appendChild($toksycznoscTag);
		
	$rootTag ->appendChild($mainTag);
	$xml ->save('zaprawy.xml');
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
        <a href="logout.php" style="color:green; font-weight:bold;" >WYLOGUJ</a>
        <div style="clear:both;"></div>
    </div>
    
	<div id="container1">

		<div class="border">
            <h1 style="color: Highlight; text-align:center; padding:5px;">ZAPRAWY</h1>
		</div>

	
		<div id="aktualnosci">   
            
            <?php
                $xml = simplexml_load_file("zaprawy.xml");

                foreach($xml -> zaprawy as $show)
                {
                    echo '<div class="tresc">';
                        echo "<b>Numer wpisu: </b>";
                        echo $show -> id."<br/>";
                        echo "<b>Nazwa: </b>";
                        echo $show -> nazwa."<br/>";
                        echo "<b>Rodzaj: </b>";
                        echo $show -> rodzaj."<br/>";
                        echo "<b>Substancje aktywne: </b>";
                        echo $show -> substAktywne -> substAktywan[0].', '. $show -> substAktywne -> substAktywan[1]. "<br/>";
                        echo "<b>Zawartość: </b>";
                        echo $show -> zawartosci -> zawartosc. "<br/>";
                        echo "<b>Toksyczność: </b>";
                        echo $show -> toksycznosc."<br/>";
                    echo '</div>';
                    ?>  
                        <form method="post" action="dodaj_wpis_zaprawy.php">
                            <input type="submit" value="Dodaj wpis" style="float:left; margin-top:6px; margin-left:10px;" />
                        </form>
                        <form action="" method="post"> 
                        <input type="text" style="width:0px; border: none; background: transparent;" name="first_tag"  readonly value="<?php echo $show -> id?>" >
                        <input type="submit" name="delete" value="Usuń wpis">
                        </form>
                        
                        <br/><br/>
            <?php
                $nr_zaprawy = $show->id + 1 ;
                $_SESSION["zaprawy"] = $nr_zaprawy;            
                }                
            ?>
		</div>
	</div>
</body>
</html>