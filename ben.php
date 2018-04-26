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

//echo "sorted - "; print_r($sortedArray);
	$allCoins = calculateCoin($sortedArray, $totalCoins);
//echo "coins - "; print_r($allCoins);	
	$output = array_sum($allCoins);

	$output = (int)$output;
	fwrite(STDOUT, $output);

	function sortArray($givenArray){
//echo "given Arr -"; print_r($givenArray);	
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

//echo "cal Arr - "; print_r($array);
		REPEATE:
		if(isset($array[0])){
			if($array[0]['ones'] > 0){
				$level = $array[0];
				$coins = $level['ones'] * $level['ones'];
				$firstLevelPositions = explode(',', $level['position']);
				array_push($totalCoins, $coins);
	//echo "before "; print_r($array);			
				array_shift($array);
	//echo "after "; print_r($array);			
				$newArray = [];
				foreach($array as $newLevel){
					$positions = explode(',', $newLevel['position']);
					foreach($firstLevelPositions as $firstLevelPosition){
						if(in_array($firstLevelPosition, $positions)){
							$newLevel['number'] = substr_replace($newLevel['number'], 0, $firstLevelPosition, 1);
						}
					}
					array_push($newArray, $newLevel['number']);
				}
				$secArray = sortArray($newArray);
				return calculateCoin($secArray, $totalCoins);
			}else{
				array_shift($array);
				goto REPEATE;
			}
		}else{
			return $totalCoins;
		}
	}
