<?php
  /* Read input from STDIN. Print your output to STDOUT*/
  $fp = fopen('php://stdin', 'r');
  //Write code here
	$values = $weaponRequired = [];
	$i = 0;
	while($line = fgets($fp)){
		if(empty($values)){
			$values = explode(" ", $line);
			$level = $values[0];
			$weapon = $values[1];
		}else{
			if(count($weaponRequired) < $level){
				$weaponRequired[$i] = $line;
				$i++;
				if(count($weaponRequired) == $level){
					break;
				}
			}else{
				break;
			}
		}
	}
	fclose($fp);
	sort($weaponRequired);
	

	
print_r($arr);	
	foreach($weaponRequired as $key => $data){
		$lastpos = 0;
		$positions = [];
		while(($lastpos = strpos($data, '1', $lastpos)) !== false){
			$positions [] = $lastpos;
			$lastpos = $lastpos + strlen(1);
		}
		
		//$level[$key];
		print_r($positions);
		echo "\n";
	}



/*
	sort($weaponRequired);
	print_r($weaponRequired);
	foreach($weaponRequired as $key => $number){
		$onesCount = preg_match_all( "/[1]/", $number );
		
		echo $number."\n";
		echo $onesCount;
		$digitWiseNumber = str_split(trim($number));
//		print_r($digitWiseNumber);
		//$required[$key] = array_sum(str_split($number));
	}
	//print_r($weaponRequired);
	*/
?>
