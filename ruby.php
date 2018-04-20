<?php
$fp = fopen('php://stdin', 'r');
$necklace = [];
while($line = fgets($fp)){
	switch(count($necklace)){
		case 0:
			$necklace['blue'] = $line;
			break;
		case 1:
			$necklace['red'] = $line;
			break;
		case 2:
			$necklace['yellow'] = $line;
			break;
		case 3:
			$necklace['green'] = $line;
			break;
		default:
			break;
	}
	if(count($necklace) >= 4)
		break;
}
fclose($fp);

	if($necklace['blue'] > 0){
		$count = $necklace['blue'];
		$necklace['blue'] = 0;
		red($necklace, $count, 'blue');
	}else if($necklace['red'] > 0){
		$count = 1;
		$necklace['red'] -= 1;
		green($necklace, $count);
	}else if($necklace['green'] > 0){
		$count = $necklace['green'];
		$necklace['green'] = 0;
		yellow($necklace, $count);
	}else if($necklace['yellow'] > 0){
		$count = 1;
		$necklace['yellow'] -= 1;
		result($count);
	}else{
		result(0);
	}

	function red($necklace, $count, $recent){
		if($necklace['red'] > 0){
			$count += 1;
			$necklace['red'] -= 1;
			green($necklace, $count);
		}else{
			if($recent == 'blue' || $recent == 'yellow'){
				result($count);
			}else{
				green($necklace, $count);
			}
		}
	}
	
	function green($necklace, $count){
		if($necklace['green'] > 0){
			$count += $necklace['green'];
			$necklace['green'] = 0;
			yellow($necklace, $count);
		}else{
			yellow($necklace, $count);
		}
	}
	
	function yellow($necklace, $count){
		if($necklace['yellow'] > 0){
			$count += 1;
			$necklace['yellow'] -= 1;
			if($necklace['red'] > 0){
				red($necklace, $count, 'yellow');
			}else{
				result($count);
			}
		}else{
			result($count);
		}
	}
	
	function result($count)
	{
		$output = (int)$count;
		fwrite(STDOUT, $output);
		exit;
	}
?>