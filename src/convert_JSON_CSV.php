<?php

class ConvertScripts{

public function convertJSONtoCSV($jsonFilename){


	if(!class_exists('CommonUtilities')){
		include 'src/utilities.php';
	}	

$util = new CommonUtilities();

$csvFilename = "csv/".$util->getDateTimeNow()."_search.csv";	

$json = file_get_contents($jsonFilename);
$array = json_decode($json, true);
$f = fopen($csvFilename, 'w');

$firstLineKeys = false;

foreach ($array as $line)
{
	if (empty($firstLineKeys))
	{
		$firstLineKeys = array_keys($line);
		fputcsv($f, $firstLineKeys);
		$firstLineKeys = array_flip($firstLineKeys);
	}
	// Using array_merge is important to maintain the order of keys acording to the first element
	fputcsv($f, array_merge($firstLineKeys, $line));
}

}

}
?>