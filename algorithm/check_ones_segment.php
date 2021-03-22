<?php

require_once 'base\AlgorithmBase.php';
//
class Solution extends \algorithm\base\AlgorithmBase
{    
    function checkOnesSegment($s) {
        $s = str_replace('0',' ',$s);
        $list = explode(' ',$s);
		print_r($list);
        $len = count($list);
        $count = 0;
        for($i = 0;$i < $len;$i++){
            $cur = $list[$i];
			echo $cur.PHP_EOL;
            if($cur != '' && strlen($cur) > 1){
                $count++;
            }
        }

        return $count == 1;
    }

	function test(){
		echo $this->checkOnesSegment('110') ? 1 : 0;
	}
}

(new Solution())->test();