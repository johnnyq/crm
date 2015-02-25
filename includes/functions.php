<?php

function check_input($value){
	// Stripslashes
	if (get_magic_quotes_gpc()){
  		$value = stripslashes($value);
  	}
	// Quote if not a number
	if (!is_numeric($value)){
		$value = mysql_real_escape_string($value);
  	}
	return $value;
}

function human_time($timestamp){
	if ($timestamp != 0){
	    $difference = time() - $timestamp; // Make different between this time and time value which pass throw $timestamp
	    $periods = array("sec", "min", "hour", "day", "week", "month", "years", "decade");
	    $lengths = array("60","60","24","7","4.35","12","10");
	    if ($difference > 0) { // this was in the past
	        $ending = "ago";
	    }else{ // this was in the future
	        $difference = -$difference;
	        $ending = "to go";
	    }
	    for($j = 0; $difference >= $lengths[$j]; $j++) $difference /= $lengths[$j];
	    $difference = round($difference);
	    if($difference != 1) $periods[$j].= "s";
	    $text = "$difference $periods[$j] $ending";
	    return $text;
	}
}

function randomWords($num) {
    $alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < $num; $i++) {
        $n = rand(0, $alphaLength);
        $randomwrd[] = $alphabet[$n];
    }
    return implode($randomwrd); //turn the array into a string
}

?>