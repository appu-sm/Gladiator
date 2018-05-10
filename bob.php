<?php
$fp = fopen('php://stdin', 'r');
$inputs = [];
while($line = fgets($fp)){
	switch(count($inputs)){
		case 0:
			$inputs['number_of_fish'] = $line;
			break;
		case 1:
			$inputs['fish_length'] = $line;
			break;
		case 2:
			$inputs['fish_start_point'] = $line; 
			break;
		case 3:
			$inputs['empty'] = $line; 
			break;
		default:
			break;
	}
	if(count($inputs) >= 4)
		break;
}
fclose($fp);

//print_r($inputs);
$fish_catched = 0;
$fish_start_point = explode(" ",$inputs['fish_start_point']);
$fish_length = explode(" ",$inputs['fish_length']);
//$totalTime = [];

	for($i = 0; $i < $inputs['number_of_fish']; $i++){
		$totalTime[$i] = $fish_start_point[$i] + $fish_length[$i];
	}
/*
	for($i = 0; $i < max($totalTime); $i++){
		if(in_array($i, $fish_start_point)){
			$fish_catched += 1;
		}
	}
*/	
	foreach($fish_start_point as $startPoint){
	//	if(in_array($i, $fish_start_point)){
			$fish_catched += 1;
	//	}
	}
echo $fish_catched;