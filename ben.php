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

	$totalCoins = [];
	$sortedArray = sortArray($weaponRequired);
	$allCoins = calculateCoin($sortedArray, $totalCoins);
	$output = array_sum($allCoins);
print_r($output); die;

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
	
	function calculateCoin($array, $totalCoins){
		if(isset($array[0])){
			$level = $array[0];
			$coins = $level['ones'] * $level['ones'];
			$firstLevelPositions = explode(',', $level['position']);
			array_push($totalCoins, $coins);
			array_shift($array);
			$newArray = [];
			foreach($array as $newLevel){
				$positions = explode(',', $newLevel['position']);
				foreach($firstLevelPositions as $firstLevelPosition){
					if(in_array($firstLevelPosition, $positions)){
						$newLevel['number'] = substr_replace($newLevel['number'], 0, $firstLevelPosition, 1);
					}
					array_push($newArray, $newLevel['number']);
				}
			}
			$secArray = sortArray($newArray);
			return calculateCoin($secArray, $totalCoins);
		}else{
			return $totalCoins;
		}
	}
