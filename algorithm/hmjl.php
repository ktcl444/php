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
/* 	解法一：可以通过按位与操作，通过将每一位和1与操作来求出1的个数。
解法二（最优解）：一个巧妙的方法，一个不为0的二进制数，肯定至少有一位是1，当这个数减一的时候，它的最后一位1会变为0，后边的所有0会变为1。比如10100，减一之后会变为10011，然后用原数字10100和10011进行与操作之后，会得到10000，也就是通过这个操作，可以将一个1变为0，所以一个二进制数字能进行多少次这样的操作，就有多少个1. */
function test($n,$flag)
{
/* 	 $count = 0;
  $flag = 1;
  while ($flag != 0) {
   if (($n & $flag) != 0) {
    $count++;
   }
   $flag = $flag << 1;
  }
  return $count; */
    $count = 0;
 while($n != 0){
  $count++;
  $n = $n & ($n-1);
 }
 return $count;
}
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