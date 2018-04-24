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
	$totalCoins = [];
	$sortedArray = sortArray($weaponRequired);
	function sortArray($givenArray){
		$seconArr = [];
		foreach($givenArray as $key => $data){
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
		return $seconArr;
	}
print_r($sortedArray);


	$allCoins = calculateCoin($sortedArray, $totalCoins);
print_r($allCoins); die;	
	$output = array_sum($allCoins);
	
	function calculateCoin($array, $totalCoins){
		if(isset($array[1])){
			$level = $array[0];
			$coins = $level['ones'] * $level['ones'];
			$firstLevelPositions = explode(',', $level['position']);
			array_push($totalCoins, $coins);
			array_shift($array);
//print_r($array); die;
			$newArray = [];
			foreach($array as $newLevel){
				$positions = explode(',', $newLevel['position']);
				foreach($firstLevelPositions as $firstLevelPosition){
					if(in_array($firstLevelPosition, $positions)){
						$newLevel['number'] = substr_replace($newLevel['number'], 0, $firstLevelPosition, 1);
					}
					array_push($newArray, $newLevel);
				}
			}
print_r($newArray);			
			$secArray = sortArray($newArray);
print_r($secArray); die;			
			return calculateCoin($secArray, $totalCoins);
		}else{
			return $totalCoins;
		}
	}
