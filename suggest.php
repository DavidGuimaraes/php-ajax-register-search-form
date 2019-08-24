<?php

/*$people[] = "David";
$people[] = "Amanda";
$people[] = "Dalva";
$people[] = "Marcos";
$people[] = "Macaca";
$people[] = "Porco";
$people[] = "Miungo";
$people[] = "Malia";
$people[] = "Matuza";
$people[] = "Teia";
$people[] = "Martelo";
$people[] = "Louga";
$people[] = "Lu";*/

$people = [];
$file = 'people.txt';
$suggestion = "";

if(file_exists($file)){
	$bufferedReader = fopen($file, 'r');
	//Gets the string returned as a query
	$q = $_REQUEST['q'];
	$suggestion = "";
	
	while(!feof($bufferedReader)){
		$line = fgets($bufferedReader);
		$nameLimit = strpos($line, "Phone");
		$name = substr($line, 6, $nameLimit-6);
		$people[] = $name;
	}

	if($q !== ""){
		$q = strtolower($q);
		$len = strlen($q);
		foreach($people as $person){
			//stristr finds the first occurence of a string
			if(stristr($q, substr($person, 0, $len))){
				if($suggestion === ""){
					$suggestion = $person;
				}else{
					$suggestion .= ", $person";
				}
			}
		}
	}
}

echo $suggestion === "" ? "No suggestions :(" : $suggestion;
?>