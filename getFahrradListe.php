<?php

	include('Result.php');
	include('Fahrrad.php');
	include('fahrradDB.php');


	$ok = true;
	$errortext = '';

	if($ok) {
		$fahrraederListe = getFahrradListeShort();
		$resultFahrradListe = new ResultFahrraeder();
		//filtern
		foreach ($fahrraederListe->liste as $fahrrad) {
			$equalsFilter = true; // Standardmäßig alle Fahrräder behalten
			//prüfen ob einer der radiobutton ausgewählt wurde
			if (isset($_GET['filterTyp'])) {
				$filterTyp = $_GET['filterTyp'];
				//prüfen ob der Fahrradtyp mit dem gesetzten Typ übereinstimmt
				if ($fahrrad->typ != $filterTyp) {
					$equalsFilter = false;
				}
			}

			//prüfen ob der minPreis und maxPreis gesetzt sind
			if (isset($_GET['minPreis']) && isset($_GET['maxPreis'])) {
				$minPreis = $_GET['minPreis'];
				$maxPreis = $_GET['maxPreis'];
				if ($fahrrad->preis < $minPreis || $fahrrad->preis > $maxPreis) {
					$equalsFilter = false; // Preis liegt außerhalb des Filterbereichs
				}
			}

			//wenn das Fahrrad dem Filter entspricht, hinzufügen in die resultFahrradListe
			if ($equalsFilter) {
				$resultFahrradListe->liste[] = $fahrrad;
			}
		}
		// Ende filtern
		echo json_encode($resultFahrradListe);
	}
	else{
		$resultFahrradListe = new resultFahrraeder();
		$resultFahrradListe->isError = true;
		$resultFahrradListe->errortext = $errortext;
		echo json_encode($resultFahrradListe);
	}


?>

