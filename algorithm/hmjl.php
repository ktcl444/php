<?php

    function hammingDistance($x, $y) {
        $result = 0;
		$x1 = getBinaryNum($x);
		$y1 = getBinaryNum($y);
        while(!empty($x1) || !empty($y1))
        {
            $x_temp = array_shift($x1);
			$y_temp = array_shift($y1);
			if($x_temp != $y_temp){
				$result +=1;
			}
        }
        return $result;
    }
	
function test($n,$flag)
{
 $count = 0;
  while ($flag != 0) {
   if (($n & $flag) != 0) {
    $count++;
   }
   $flag = $flag << 1;
  }
  return $count;
}

    function getBinaryNum($x)
    {
		$result = [];
		while($x!=0){
			
			$result[]= intval($x%2);
			$x = intval($x/2);
		}
		
		return $result;
    }
echo hammingDistance( 3,1);
echo test((1 ^ 3),2);