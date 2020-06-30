<?php

require_once 'base\AlgorithmBase.php';

//水壶问题-数学(ax+by=z z为x,y最大公约数的整数倍)
class Solution extends \algorithm\base\AlgorithmBase
{
	function canMeasureWater($x, $y, $z) {
		if($x+$y<$z)
			return false;
		if($x == 0 || $y == 0){
			return $z == 0 || $x + $y == $z;
		}
		
		return $z % $this->gcd($x,$y) == 0;
    }
	
	function test(){
		echo ($this->canMeasureWater(3,5,4)?'1':'0').PHP_EOL;
	}
}

(new Solution())->test();