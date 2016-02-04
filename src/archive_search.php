<?php

class ArchiveFile {

	public function archiveFile () {

	if(!class_exists('CommonUtilities')){
		include 'src/utilities.php';
	}

	$util = new CommonUtilities();

	$origFile = "data/search.json";
	$origFile2 = "data/search_full.json";

	$newFileName = "data/archive/search-".$util->getDateTimeNow().".json";
	$newFileName2 = "data/archive/search_full-".$util->getDateTimeNow().".json";

	
	file_put_contents($newFileName, file_get_contents($origFile), FILE_APPEND);
	file_put_contents($newFileName2, file_get_contents($origFile2), FILE_APPEND);


	file_put_contents($origFile, "");
	file_put_contents($origFile2, "");


	

	}


}

?>