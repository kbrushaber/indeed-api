<?php

class CommonUtilities {



	public static function getDateTimeNow() {
    	$tz_object = new DateTimeZone('America/Chicago');
 
	    $datetime = new DateTime();
   		$datetime->setTimezone($tz_object);
    	return (String) $datetime->format('m-d-Y_hia');
	}
}
?>