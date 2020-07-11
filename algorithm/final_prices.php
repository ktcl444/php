<?php

require_once 'base\AlgorithmBase.php';

//商品折扣后的最终价格-迭代+暴力
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 迭代
	function finalPrices($prices) {       
		$stack = [0=>$prices[0]];
		$len = count($prices);
		$ans = [];
		for($i = 1;$i < $len;$i++){
			while(!empty($stack) && $prices[$i]<=end($stack)){
				$ans[key($stack)] =  end($stack) - $prices[$i];
				array_pop($stack);
			}
			$stack[$i] = $prices[$i];
		}
		
		foreach($stack as $key => $value){
			$ans[$key] = $value;
		}
		
		ksort($ans);
		
		return $ans;
	}
	#endregion
	
	#region 暴力
    function finalPrices1($prices) {        
        $ans = [];
        $len = count($prices);
        for($i = 0;$i < $len;$i++){
            $cur = $prices[$i];
            $j = $i+1;
            while($j < $len && $prices[$j] > $cur){
                $j++;
            }
            $discount = $j < $len ? $prices[$j] : 0;
            $ans[] = $cur - $discount;
        }

        return $ans;
    }
	#endregion
	
	function test(){
		echo(ord('a')).PHP_EOL;
		echo (ord('z')).PHP_EOL;
		print_r($this->finalPrices([8,4,6,2,3]));
	}
}

(new Solution())->test();