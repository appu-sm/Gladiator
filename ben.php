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
//	print_r($values);
	print_r($weaponRequired);

/*	
	foreach($weaponRequired as $key => $number){
		$required[$key] = array_sum(str_split($number));
	}
*/	
	sort($weaponRequired);
	foreach($weaponRequired as $key => $number){
		$digitWiseNumber = str_split(trim($number));
		print_r($digitWiseNumber);
		//$required[$key] = array_sum(str_split($number));
	}
	//print_r($weaponRequired);
?>
