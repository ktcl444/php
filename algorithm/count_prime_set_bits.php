<?php

require_once 'base\AlgorithmBase.php';
//二进制表示中质数个计算置位
class Solution extends \algorithm\base\AlgorithmBase
{

    function countPrimeSetBits($L, $R) {
		        $count = 0;
        for ($i = $L; $i <= $R; $i++) {
            if (in_array(substr_count(decbin($i), '1'), [2, 3, 5, 7, 11, 13, 17, 19])) {
                $count++;
            }
        }
        return $count;
		
        $ans = 0;
        $mapping = [];
        for($i = $L;$i <= $R;$i++){
            $count = 0;
            $temp = $i;
            while($temp != 0){
                $temp &= $temp - 1;
                $count++;
            }
            if(array_key_exists($count,$mapping)){
                $ans++;
            }else{
                if($this->check($count)){
                    $ans++;
                    $mapping[$count] = 1;
                }
            }
        }
		
		print_r($mapping);

        return $ans;
    }

    function check($num){
//return ($num == 2 || $num == 3 || $num == 5 || $num == 7 || $num == 11 || $num == 13 || $num == 17 || $num == 19);

        $center = sqrt($num);
        $temp = 2;
        while($temp <= $center){
            if($num % $temp == 0){
                return false;
            }
            $temp++;
        }

        return $num != 1;
    }

	function test(){
		echo($this->countPrimeSetBits(244,269)).PHP_EOL;
	}
}

(new Solution())->test();