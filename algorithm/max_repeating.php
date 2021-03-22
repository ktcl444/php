<?php

require_once 'base\AlgorithmBase.php';
//
class Solution extends \algorithm\base\AlgorithmBase
{    
    function maxRepeating($sequence, $word) {
        $max = strlen($sequence);
        $len = strlen($word);
        $times = floor($max / $len);
        $ans = 0;
        $time = 1;
		$temp = $word;
        while($time <= $times){
			$index = strpos($sequence,$temp);
			//echo $temp.PHP_EOL;
			//echo $index.' '.$time.PHP_EOL;
            if(strpos($sequence,$temp)!== FALSE){
                $ans = $time;
            }
            $temp .= $word;
            $time++;
        }
        return $ans;
    }

	function test(){
		print_r($this->maxRepeating('aaabaaaabaaabaaaabaaaabaaaabaaaaba','aaaba'));
	}
}

(new Solution())->test();