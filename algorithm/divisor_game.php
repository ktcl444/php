<?php

require_once 'base\AlgorithmBase.php';
//除数博弈
class Solution extends \algorithm\base\AlgorithmBase
{

    function divisorGame($N) {
        $dp = array_fill(0,$N,0);
        $dp[2] = 1;
        $x = 3;
        $last = 2;
        $last_sign = 1;
        while($x <= $N){
            $diff = $x - $last;
            if($diff > 0 && $diff < $x && $x % $diff == 0){
				$last_sign = 1 - $last_sign;
                $dp[$x] = $last_sign;
                $last = $x;
            }
            $x++;
        }

        return $dp[$N] == 1;
    }

	function test(){
		echo($this->divisorGame(4)?'1':'0').PHP_EOL;
	}
}

(new Solution())->test();