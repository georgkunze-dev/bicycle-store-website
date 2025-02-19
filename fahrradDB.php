<?php



		function getConnection() {
				$servername='localhost';
				$username='root';
				$passwd='';
				$database='fahrrad';
				$conn = new mysqli($servername, $username, $passwd, $database);
				if ($conn->connect_error)  {
						die('Connection failded: ' . $conn->connect_error);
				}
				return $conn;
		}

		function getDBSequence1() {
				$conn = getConnection();
				if ($conn->connect_error)  {
						return 0;
				}


				$sql = 'UPDATE sequence SET id=LAST_INSERT_ID(id+1);';
				$result = $conn->query($sql);
				if ( $result ){
						$sql ='SELECT LAST_INSERT_ID()';
						$result = $conn->query($sql);
						if ( $result ){
						while ( $row = $result->fetch_array() ) {
						$sequence = intval($row[0]) ;
						} // while
						}  // if
						else {
						echo '2. sql ist false<br />';
						}
				}
				else {
						echo '1. sql ist false<br />';
						die('SQL-Anweisung gescheitert');
				}
				return $sequence;
		}



		function getFahrradListeShort() {
				$result = new ResultFahrraeder();

				$conn = getConnection();
				if ($conn->connect_error)  {
						$result->isError=true;
						$result->error = $conn->connect_error;
						return $result;
				}
				$sql = "SET NAMES 'utf8'";
				$resultSQL = $conn->query($sql);


				$sql = 'SELECT PINDEX, BELEUCHTUNG, BEZ, BILD, BREMSE, ELEKTRO, GAENGE, GEWICHT, PREIS, RADGROESSE, RAHMENHOEHE, TYP  FROM FAHRRAD ORDER BY BEZ';
				$resultSQL = $conn->query($sql);
				if ( $resultSQL ){
						while ( $row = $resultSQL->fetch_array() ) {
						$fahrrad = new Fahrrad();
						$fahrrad->pindex = intval ( $row['PINDEX'] );

						$fahrrad->beleuchtung = trim($row['BELEUCHTUNG']);
						$fahrrad->bez = trim($row['BEZ']);
						$fahrrad->bild = trim($row['BILD']);
						$fahrrad->bremse = trim( $row['BREMSE'] );
						$fahrrad->elektro = trim( $row['ELEKTRO'] );
						$fahrrad->gaenge = intval ( $row['GAENGE'] );
						$fahrrad->gewicht = intval ( $row['GEWICHT'] );
						$fahrrad->preis = floatval ( $row['PREIS'] );
						$fahrrad->radgroesse = intval ( $row['RADGROESSE'] );
						$fahrrad->rahmenhoehe = intval ( $row['RAHMENHOEHE'] );
						$fahrrad->typ = trim( $row['TYP'] );

						$result->liste[]=$fahrrad;

						} // while
				}
				else {
						$result->isError=true;
						$result->error = 'Fehlerhafte SQL-Anweisung<br />' . $conn->error . '<br />' . $sql;
				}
				return $result;
		} // getFahrradListeShort



		function getFahrrad($pindex) {
				$result = new ResultFahrrad();
				$result->fahrrad = new Fahrrad();

				$conn = getConnection();
				if ($conn->connect_error)  {
						$result->isError=true;
						$result->error = $conn->connect_error;
						return $result;
				}
				$sql = "SET NAMES 'utf8'";
				$resultSQL = $conn->query($sql);


				$sql = 'SELECT PINDEX, BELEUCHTUNG, BEZ, BILD, BREMSE, ELEKTRO, GAENGE, GEWICHT, PREIS, RADGROESSE, RAHMENHOEHE, TYP  ' .
				' FROM FAHRRAD WHERE PINDEX=' . $pindex;
				//echo $sql . '<br />';

				$resultSQL = $conn->query($sql);
				if ( $resultSQL ){
						//echo '1<br />';
						while ( $row = $resultSQL->fetch_array() ) {
						$fahrrad = new Fahrrad();

						$fahrrad->pindex = intval ( $row['PINDEX'] );

						$fahrrad->beleuchtung = trim($row['BELEUCHTUNG']);
						$fahrrad->bez = trim($row['BEZ']);
						$fahrrad->bild = trim($row['BILD']);
						$fahrrad->bremse = trim( $row['BREMSE'] );
						$fahrrad->elektro = trim( $row['ELEKTRO'] );
						$fahrrad->gaenge = intval ( $row['GAENGE'] );
						$fahrrad->gewicht = intval ( $row['GEWICHT'] );
						$fahrrad->preis = floatval ( $row['PREIS'] );
						$fahrrad->radgroesse = intval ( $row['RADGROESSE'] );
						$fahrrad->rahmenhoehe = intval ( $row['RAHMENHOEHE'] );
						$fahrrad->typ = trim( $row['TYP'] );
						} // while
						$result->fahrrad = $fahrrad;
				}
				else {
						$result->isError=true;
						$result->error = 'Fehlerhafte SQL-Anweisung<br />' . $conn->error . '<br />' . $sql;
				}
				return $result;
		} // getFahrrad



?>
