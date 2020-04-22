<?php

require_once 'base\AlgorithmBase.php';

//杨辉三角-动态规划
class Solution extends \algorithm\base\AlgorithmBase
{
/* 	1
	1 1
	1 2 1
	1 3 3 1
	1 4 6 4 1 */
    function generate($numRows) {
		$triangle = [];
        for ($i = 0; $i < $numRows; $i++) {
            $triangle[$i][0] = 1;
            for ($j = 1; $j <= $i; $j++) {
                $triangle[$i][$j] = $triangle[$i - 1][$j - 1] + $triangle[$i - 1][$j];
            }
        }
        return $triangle;
    }
	
	function test(){
		print_r($this->generate(5));
	}
}

(new Solution())->test();