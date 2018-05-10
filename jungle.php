<?php
$fp = fopen('php://stdin', 'r');
  //Write code here
	$values = [];
	$i = 0;
	$tree_inputs = [];
	while($line = fgets($fp)){
		if(empty($values)){
			$values = explode(" ", $line);
			$no_of_trees = $values[0];
			$jump_capacity = $values[1];
		}else{
			if(count($tree_inputs) < $no_of_trees){
				$tree_inputs[$i] = $line;
				$i++;
				if(count($tree_inputs) == $no_of_trees){
					break;
				}
			}else{
				break;
			}
		}
	}
	fclose($fp);
//print_r($tree_inputs);

	foreach($tree_inputs as $tree_position => $trees){
		$treeArr = explode(" ",$trees);
//	print_r($treeArr);	
		if((int)$treeArr[2] > (int)$treeArr[3]){
			$meeting_can_happen[$tree_position] = 0;
		}else{
			$meeting_can_happen[$tree_position] = 1;
		}
	}
//print_r($meeting_can_happen);	
$count = 0 ;	
	foreach($meeting_can_happen as $meet){
		if($meet == 0)
			$count += 1;
	}
if($count > 1){
	echo -1;
}else{
	foreach($tree_inputs as $tree_position => $trees){
		echo $tree_position." ";
	}
}