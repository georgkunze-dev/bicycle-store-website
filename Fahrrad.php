
<?php


	class Fahrrad{
		public $pindex=0;
		public $beleuchtung='';
		public $bez='';
		public $bild='';
		public $bremse='';
		public $elektro='';
		public $gaenge=0;
		public $gewicht=0;
		public $preis=0;
		public $radgroesse=0;
		public $rahmenhoehe=0;
		public $typ='';


		public function  __construct($pindex=0, $beleuchtung='', $bez='', $bild='', $bremse='', $elektro='', $gaenge=0, $gewicht=0, $preis=0, $radgroesse=0, $rahmenhoehe=0, $typ='') {
			$this->pindex = $pindex;
			$this->beleuchtung = $beleuchtung;
			$this->bez = $bez;
			$this->bild = $bild;
			$this->bremse = $bremse;
			$this->elektro = $elektro;
			$this->gaenge = $gaenge;
			$this->gewicht = $gewicht;
			$this->preis = $preis;
			$this->radgroesse = $radgroesse;
			$this->rahmenhoehe = $rahmenhoehe;
			$this->typ = $typ;
		}



	}  // class Fahrrad





?>
