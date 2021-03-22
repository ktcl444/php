<?php

require_once 'base\AlgorithmBase.php';
//查询带键的排列-双hash存储数值和位置
class Solution extends \algorithm\base\AlgorithmBase
{    
    function processQueries($queries, $m) {
        $p = [];
        $map = [];
        for($i = 1;$i <= $m;$i++){
            $p[$i-1] = $i;
            $map[$i] = $i-1;
        }
        $ans = [];
        foreach($queries as $q){
			//print_r($p);
            $pos = $map[$q];
            for($i = $pos-1;$i >= 0;$i--){
                $map[$p[$i]] = $i+1;
                $p[$i+1] = $p[$i];
            }
                $map[$q] = 0;
                $p[0] = $q;
            $ans[] = $pos;
			//print_r($p);
        }

        return $ans;
    }

	function test(){
		print_r($this->processQueries([3,1,2,1],5));
	}
}

(new Solution())->test();