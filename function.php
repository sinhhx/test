<?php
function is_Add($add){
	
       // tach dia chi nha
    //preg_match_all('/([\d]+)/', $add, $match);
    $ok = false;
	if( preg_match('([a-zA-Z].*[0-9]|[0-9].*[a-zA-Z])', $add)) $ok = true;

	return $ok;
}

function get_Str_Num($add){
	if ( preg_match('/([^\d]+)(\s)?(.+)/i', $add, $result) )//||\D
	{
	    // $result[1] will have the steet name
	    //var_dump($result);
	    $streetName = $result[1];
	    if (strlen($streetName) >= 30) $result[1] = "#";
	    // and $result[2] is the number part. 
	    $streetNumber = $result[3];
	    //echo "<hr>Number :".$streetNumber;
	    if (strlen($streetNumber) >= 10) $result[2] = "#";
	}
	return $result;	
}



/*
					    $subject = $add;
					       	// tach dia chi nha
					    	//preg_match_all('/([\d]+)/', $add, $match);
					    	preg_match_all('!\s(\d.*)!', $add, $match);
							//var_dump($match);
   							if (!isset($match[0][0])) $haus_nummer = "#";
					    	else $haus_nummer = $match[0][0];
   							//echo "<br>Haus Nummer: = ".$haus_nummer." von ".$mang2['firstname'];
   							if (strlen($haus_nummer)>11) $haus_nummer = "#";
   							$add = str_replace($haus_nummer,'', $add);
   							//////////////////////////////////////////////
                    // Find a match and store it in $result.
							if ( preg_match('/([^\d]+)\s?(.+)/i', $subject, $result) )
							{
							    // $result[1] will have the steet name
							    $streetName = $result[1];
							    // and $result[2] is the number part. 
							    $streetNumber = $result[2];
							    echo "<br> === ".$streetName." === ".$streetNumber."<br>";
							}
   							//////////////////////////////////////////////
   							//echo "Address neue: ".$add;
*/

?>