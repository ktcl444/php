<?php

require_once 'base\AlgorithmBase.php';
//换酒喝
class Solution extends \algorithm\base\AlgorithmBase
{

    function numWaterBottles($numBottles, $numExchange) {
        $total  = 0;
        $empty = 0;
        while($numBottles > 0 ){
            $total += $numBottles;
            $empty += $numBottles;
            $numBottles = intval($empty / $numExchange);
            $empty = $empty % $numExchange;
			
/* 			echo 'b:'.$numBottles.' em:'.$empty.' ex:'.$extra.' t:'.$total.PHP_EOL;
			            if($total > 20)
            break; */
        }

        return $total;
    }
	function test(){
		echo ($this->numWaterBottles(15,4)).PHP_EOL;
	}
}

(new Solution())->test();