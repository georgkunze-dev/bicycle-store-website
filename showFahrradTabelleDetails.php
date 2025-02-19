<html>
	<head>
		<title>Fahrräder Direktvergleich</title>
		<meta name="Georg Kunze" content="Administrator"/>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css"  href="showFahrradTabelleDetails.css" title="style1"/>
	</head>

<body>
	<h1 class="ueberschrift1">Fahrrad<span style="color: #fcd202">.</span>de</h1>
	<h4 class="ueberschrift2">Ihr Fahrradshop für jede Gelegenheit</h4> <br/> <br/>
	<div class="title">Fahrräder Direktvergleich</div>

<?php
	include("Result.php");
	include("Fahrrad.php");
	include("fahrradDB.php");

	function createFahrradZeilen($fahrrad) {
		$feld = array();
		$feld[] = $fahrrad->typ;
		$feld[] = $fahrrad->bez;
		$feld[] = $fahrrad->beleuchtung;
		$feld[] = $fahrrad->bremse;
		$feld[] = $fahrrad->elektro;
		$feld[] = $fahrrad->gaenge;
		$feld[] = $fahrrad->gewicht . ' kg';
		$feld[] = $fahrrad->radgroesse . '"';
		$feld[] = $fahrrad->rahmenhoehe . ' cm';
		$feld[] = $fahrrad->preis . '€';

		return $feld;
	}


	$ok = true;
	$listePindex = array();
	$error = '';
	$liste = array();
	//überprüfen, ob der pindex gesetzt ist und zu $listePindex[] hinzufügen
	if ( isset($_GET['pindex']) ){
		foreach ($_GET['pindex'] as $item) {
			$listePindex[] = $item;
		}
	}
	else {
		$ok = false;
		$error.="Error: Der Parameter 'pindex' wurde nicht übergeben<br />";
	}


	if ($ok) {
		$listeFahrrad = array();
		foreach($listePindex as $pindex) {
			//Fahrrad aus der Datenbank anhand des pindex holen
			$result = getFahrrad($pindex);
			if ($result->isError) {
				echo $result->error;
			}
			else {
				$listeFahrrad[] = $result->fahrrad;
			}
		}  // foreach
		$anzCols = count($listeFahrrad);

		//Tabelle erstellen
		$s='<table>';
		//Tabellenkopf
		$s.='<tr><th class="thbez"></th>';
		foreach($listeFahrrad as $fahrrad) {
			$s.="<th class=\"thbez\">$fahrrad->bez</th>" ;
		}
		$s.='</tr>';

		$FahrradBeschreibung = array("Kategorie", "Name", "Beleuchtung enthalten", "Bremse", "Elektroantrieb vorhanden", "Gaenge", "Gewicht", "Radgroesse", "Rahmenhoehe", "Preis");


		$zeilenArray=array();
		foreach($listeFahrrad as $fahrrad) {
			$zeilenArray[]=createFahrradZeilen($fahrrad);
		}

		for ($i=0; $i<count($FahrradBeschreibung); $i++) {
			// nun jeweils eine Zeile schreiben
			$s.='<tr>';
			$s.="<th class=\"thspalte\">$FahrradBeschreibung[$i]</th>" ;
			foreach($zeilenArray as $zeilen) {
				$s.="<td>$zeilen[$i]</td>" ;
			}
			$s.='</tr>';
		} // for zeilen


		$s.='</table>';
		echo $s;

	}
	else {
		echo '<h3>Fehler</h3>';
		echo $error;
	}
?>

</body>

<footer>
<h3 class="footer-text1">Georg Kunze, m28909</h3>
<h4 class="footer-text2">Webprogrammierung SoSe2023</h4>
</footer>

</html>