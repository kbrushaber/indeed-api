<?php
require 'src/indeed2.php';
require 'src/utilities.php';
class JobQuery {





	public function postJobQueryShort($query, $location){
		
		$this->postJobQuery($query, $location, 25, 0, null);

	}


	public function postJobQuery($query, $location, $start, $fromage){
		$indeedpubkey = 12345; //update this to be your Indeed Pub Key

		$client = new IndeedAPI($indeedpubkey,"json");
		$params = array(
			"q" => $query,
			"l" => $location,
			"limit" => 25,
			"start" => $start,
			"fromage" => $fromage,
			"st" => "employer"
		);

		// Set Query Params
		$client->setDefaultParams($params);

		//Post Query
		$resultSet=$client->query($params);

		//Save Results to a file
		$this->saveJSONFiles($resultSet);


		// Looking to see if we have more values to pick up
		$resultsCompare = json_decode(json_encode($resultSet),true);
		$endStamp = intval($resultsCompare['end']);
		$totalStamp = intval($resultsCompare['totalResults']);


			do  {

				if ($endStamp != $totalStamp){

				
				$start = $start + 25;
			
				self::postJobQuery($query,$location,$start,$fromage);
				}
				else {break;}

			} while ($this->$endStamp != $this->$totalStamp);  // For some reason it didn't like my while statment so I added a nested if and break out. 


	}

	

	public function saveJSONFiles($resultsFull){

		$util = new CommonUtilities();

		$this->appendFile("data/search_full.json", $resultsFull);
		$resultsConvert = json_decode(json_encode($resultsFull),true);
	
		$resultsSnippet = array();


		//Removing the headers and saving the juicy bits
		foreach($resultsConvert['results'] as $aSnip) {
			$jobtitle = $aSnip['jobtitle'];
			$jobkey   = $aSnip['jobkey'];
			$company  = $aSnip['company'];
			$date    = $aSnip['date'];
			$url      = $aSnip['url'];
			$deleted = (boolean)false;
			$applied = (boolean)false;
			$querydate = $util->getDateTimeNow();

			$toapply = array("jobtitle" => $jobtitle, "jobkey" => $jobkey, 
				"company" => $company, "date" => $date, "url" => $url, 
				"deleted" => $deleted, "applied" => $applied, 
				"querydate" => $querydate
				);

			$resultsSnippet[] = $toapply;
		}

		$this->appendFile("data/search.json", $resultsSnippet);

	}

	public function appendFile($file, $inputData){
	//Converts over and saves as JSON files
	$json_string = json_encode($inputData, JSON_PRETTY_PRINT);
	file_put_contents($file, $json_string, FILE_APPEND);

	//strips out extra Array Tags so Angular can display it correctly
	$this->stripExtraArray();
	}


	function stripExtraArray(){

		$fileContents = file_get_contents("data/search.json");

		$strippedFile= str_replace("][", ",",$fileContents);

		file_put_contents("data/search.json", $strippedFile);

		$fileContents = file_get_contents("data/search.json");

		$strippedFile= str_replace(",,", ",",$fileContents);

		file_put_contents("data/search.json", $strippedFile);

		$fileContents = file_get_contents("data/search.json");

		$strippedFile= str_replace(",]", "]",$fileContents);

		file_put_contents("data/search.json", $strippedFile);


	}

}
?>



