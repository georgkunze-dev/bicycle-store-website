
// <![CDATA[

"use strict";

let xmlhttpArtikeltabelle = new XMLHttpRequest();
xmlhttpArtikeltabelle.onreadystatechange = receiveJsonArtikeltabelle;


//startAjax
function callArtikeltabelle() {
	"use strict";
	let param = 'getFahrradListe.php';
	xmlhttpArtikeltabelle.open("GET", param);
	xmlhttpArtikeltabelle.setRequestHeader('Pragma', 'no-cache');
	xmlhttpArtikeltabelle.setRequestHeader('Cache-Control', 'must-revalidate');
	xmlhttpArtikeltabelle.send();
}  //startAjax



//startAjax2
function filtersetzen() {
	"use strict";
	let filterTypSelected = document.querySelector('input[name="filterTyp"]:checked');
	let minPreis = document.getElementById('minPreis').value;
	let maxPreis = document.getElementById('maxPreis').value;
	let param = 'getFahrradListe.php';

	if (filterTypSelected) {
		param += '?filterTyp=' + filterTypSelected.value;
	}
	if (minPreis !== '' && maxPreis !== '') {
		if (param.includes('?')) {
			param += '&';
		}
		else {
			param += '?';
		}
		param += 'minPreis=' + minPreis + '&maxPreis=' + maxPreis;
	}
	xmlhttpArtikeltabelle.open("GET", param);
	xmlhttpArtikeltabelle.setRequestHeader('Pragma', 'no-cache');
	xmlhttpArtikeltabelle.setRequestHeader('Cache-Control', 'must-revalidate');
	xmlhttpArtikeltabelle.send();
}  // startAjax2




function getFahrradStyles() {
	"use strict";
	return '<link rel="stylesheet" type="text/css"  href="showartikeltable.css" title="style1"/>';
}  //function getFahrradStyles




function  checkboxClick(mainid) {
	"use strict";

	// 1:label   2: Text  3: CheckBox
	let label = document.getElementById(  (mainid+1).toString() );
	let text = document.getElementById(  (mainid+2).toString() );
	let checkbox = document.getElementById(  (mainid+3).toString() );

	// display-Properties  none; inline; block; inline-block
	if (checkbox.checked ) {
		checkbox.checked=false;
		label.innerHTML='\u274C';
		text.className = "vergleichenBlack";
	}
	else {
		checkbox.checked=true;
		label.innerHTML='\u2705';
		text.className = "vergleichenGreen";
	}
}  // function checkboxClick



function createArticleCell(artikel, mainnr) {
	"use strict";
	let s = '<div id="fahrrad">\n';
	s+= '<div class="caption">' + artikel.bez + '</div><br />\n';

	//Tabelleninhalt
	s+='<img src="' + "img/" + artikel.bild + '" title="' + artikel.bez + '"  height="250" />\n'  ;
	s+='<ul>\n';
	s+='<li>' + 'Kategorie: ' + artikel.typ+ '</li>' + '\n';
	s+='<li>' + 'Name: ' + artikel.bez+ '</li>' + '\n';
	s+='<li>' + 'Beleuchtung enthalten: ' + artikel.beleuchtung+ '</li>' + '\n';
	s+='<li>' + 'Bremse: ' + artikel.bremse+ '</li>' + '\n';
	s+='<li>' + 'Elektroantrieb vorhanden: ' + artikel.elektro+ '</li>' + '\n';
	s+='<li>' + 'Gaenge: ' + artikel.gaenge+ '</li>' + '\n';
	s+='<li>' + 'Gewicht: ' + artikel.gewicht+ ' kg' + '</li>' + '\n';
	s+='<li>' + 'Radgroesse: ' + artikel.radgroesse+ '″' + '</li>' + '\n';
	s+='<li>' + 'Rahmenhoehe: ' + artikel.rahmenhoehe+ ' cm' + '</li>' + '\n';
	s+='<li>' + 'Preis: ' + artikel.preis + '€' + '</li>' + '\n';
	s+='<li style="visibility: hidden;">' + 'Pindex: ' + artikel.pindex + '</li>' + '\n';
	s+='</ul>' + '\n';

	s+='<input id="button_kaufen" type="button" value="Jetzt Kaufen!" onclick=""/>\n';

	//Vergleichen Checkbox
	let mainnr1 = mainnr+1;
	let mainnr2 = mainnr+2;
	let mainnr3 = mainnr+3;
	s+='<div id="vergleichen">\n';
	s+='<label id="'+mainnr1 + '" onclick="checkboxClick('+mainnr+')"  >&#x274C;</label>\n';
	s+= '<span id="'+mainnr2+'" onclick="checkboxClick('+mainnr+')\" >Vergleichen</span>\n';
	s+='</div>\n';
	s+= '<input type="checkbox" class="ckbox" name="pindex[]" value="'+artikel.pindex+'"  id="'+mainnr3+'"  />\n';

	s+= '<br/><br/><br/><br/>\n';
	s+='</div>\n';
	return s;
}  //function createArticleCell




function validation() {
	"use strict";
	let elements = document.getElementsByClassName("ckbox");
	let anz = 0;
	for (let i in elements) {
		let chkbox = elements[i];
		if (chkbox.checked ) {
			anz++;
		} // if
	} // for
	if (anz>3) {
		alert('Bitte markieren Sie maximal drei Artikel');
		return false;
	}

	if (anz<2) {
		alert('Bitte markieren Sie mindestens zwei Artikel (maximal drei Artikel)');
		return false;
	}
	return true;
}  //function validation




function getFilterStrings(fahrradListe) {
	"use strict";
	let s='';
	s+='<div id="filter">\n';
	s+='<h2 id="filterueberschrift1">Filter</h2>\n';

	s+='<h3>Kategorie</h3>\n';
	s+='<input type="radio" name="filterTyp" value="Citybike"/> Citybike <br />\n';
	s+='<input type="radio" name="filterTyp" value="E-Bike"/> E-Bike <br />\n';
	s+='<input type="radio" name="filterTyp" value="Kinderrad"/> Kinderrad <br />\n';
	s+='<input type="radio" name="filterTyp" value="Klapprad"/> Klapprad <br />\n';
	s+='<input type="radio" name="filterTyp" value="Mountainbike"/> Mountainbike <br />\n';
	s+='<input type="radio" name="filterTyp" value="Rennrad"/> Rennrad <br /><br/><br/>\n';

	s+='<h3>Preis</h3>\n';
	s+='min. <input type="text" id="minPreis" name="minPreis" value="0" size="12" style="margin-left: 5px" /><br />\n';
	s+='max. <input type="text" id="maxPreis" name="maxPreis" value="99999" size="12" /><br/><br/><br/>\n';
	s+='<input type="button" value="Filter anwenden" onclick="filtersetzen()" style="width: 200px;"/><br/>\n';

	s+='<h2 id="filterueberschrift2">Vergleichen</h2><br/>\n';
	s+='<p class="info-caption">Info:</p>';
	s+='<p class="info-text">Zum vergleichen<br/>bitte mindestens<br/>zwei und maximal<br/>drei Fahrräder<br/>auswählen</p>'
	s+='<input type="submit" value="Jetzt Vergleichen" style="width: 200px;"/>';

	s+='</div>\n';  //Ende des Filter div
	return s;
}  //function getFilterStrings




function createFahrradTable(fahrradListe) {
	"use strict";
	let elementAjax = document.getElementById("ajax");
	let s = '';
	s+=getFahrradStyles();

	//form für showFahrradTabelleDetails.php
	let sf1=' onsubmit="return validation()" ';
	let sf2=' action="showFahrradTabelleDetails.php" ';
	s+='<form  method="get"'  + sf1 + sf2 + '>\n';  //form Vergleichen
	s+='<div>';  // 1. div
	s+='<div class="title">Unsere Auswahl an Fahrrädern</div><br /><br />\n';

	// Grid für die Filter und Fahrraeder
	s+='<div id="wrapper1">\n';
	s+=getFilterStrings(fahrradListe) ;

	// Grid für die Fahrraeder, zwei gleichbreite Spalten
	s+='<article class="fahrraeder">\n';
	s+='<div id="wrapperdialog2">\n';
	let mainnr = 100;
	for (let fahrrad of fahrradListe) {
		s += createArticleCell(fahrrad,mainnr);
		mainnr += 100;
	}

	s+='</div>\n';  // wrapperdialog2
	s+='</article>\n'; // fahrraeder
	s+='</div>\n';  // wrapper1
	s+='</div>';  // 1. div ende
	s+='</form>\n';  //Ende form zum Vergleichen der Fahrräder
	elementAjax.innerHTML = s;
}  //function createFahrradTable




function receiveJsonArtikeltabelle() {
	"use strict";
	if (xmlhttpArtikeltabelle.readyState == 4) {
		if (xmlhttpArtikeltabelle.status == 200) {
			let elementAjax = document.getElementById("ajax");
			let resultFahrraeder = JSON.parse(xmlhttpArtikeltabelle.responseText);
			if (resultFahrraeder.isError) {
				elementAjax.innerHTML = "<h2> Fehler </h2> " + resultFahrraeder.errortext;
			}
			else {
				createFahrradTable(resultFahrraeder.liste);
			}
		}  // if
		else {
			let error = 'Fehler:\nStatus: '+xmlhttpArtikeltabelle.status +'\nStatusText: '+xmlhttpArtikeltabelle.statusText;
			alert(error);
		}
	}  // if
}  //function receiveJsonArtikeltabelle


// ]]>