<?php

require '..\base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{

	function luckyNumbers ($matrix) {
        $min_row = [];
        $max_col = [];
        foreach($matrix as $row){
            $min_row[] = min($row);
        }

        for($i = 0;$i < count($matrix[0]);$i++){
            $max_col[] = max(array_column($matrix,$i));
        }

        return array_intersect($min_row,$max_col);
    }

    function test()
    {
		print_r($this->luckyNumbers([
			[3,7,8],
			[9,11,13],
			[15,16,17]
		]));
    }
}

(new Solution())->test();