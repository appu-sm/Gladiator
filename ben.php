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
	$arr = [];
/*
	foreach($weaponRequired as $number){
		$onesCount = preg_match_all( "/[1]/", $number );
		$newArr['count'] = $onesCount;
		$newArr['number'] = $number;
		array_push($arr, $newArr);
	}
	usort($arr, function ($a, $b){
		return $a['count'] - $b['count'];
	});
*/	

	
//print_r($arr);	
$seconArr = [];
	foreach($weaponRequired as $key => $data){
		$lastpos = 0;
		$positions = [];
		$level = [];
		while(($lastpos = strpos($data, '1', $lastpos)) !== false){
			$positions [] = $lastpos;
			$lastpos = $lastpos + strlen(1);
		}
		
		//$level[$key];
		$level['ones'] = count($positions);
		$level['position'] = implode(',',$positions);
		$level['number'] = $data;
		array_push($seconArr, $level);
	}

	usort($seconArr, function ($a, $b){
		return $a['ones'] - $b['ones'];
	});
print_r($seconArr);
$coins = [];
	foreach($seconArr as $key => $arra){
		$coin = $arra['ones'] * $arra['ones'];
		array_push($coins, $coin);
		if($key == 0){
			$minNumber = $arra['number'];
		}
		cost($minNumber, $arra['number']);
	}

	function cost($a, $b)
	{
		$c =  ($a ^ $b) ;//& $b;
		print_r($c);
	}
?>
