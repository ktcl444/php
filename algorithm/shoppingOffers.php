<?php

require_once 'base\AlgorithmBase.php';
//大礼包-递归
class Solution extends \algorithm\base\AlgorithmBase
{   
    private $map;
    function shoppingOffers($price, $special, $needs) {
        $this->map = [];
        return $this->dfs($price, $special, $needs);
    }

    function dfs($price, $special, $needs){
        $needs_key = $this->getMapKey($needs);
        if(array_key_exists($needs_key,$this->map)){
            return $this->map[$needs_key];
        }
        $ans = 0;
        foreach($needs as $i => $count){
            $ans += $price[$i] * $count;
        }

        foreach($special as $special_item){
            $needs_temp = $needs;
            for($i = 0,$len = count($needs_temp);$i < $len;$i++){
                $diff = $needs_temp[$i] - $special_item[$i];
                if($diff < 0){
                    break;
                }
                $needs_temp[$i]  = $diff;
            }
            if($i == $len){
                $ans = min($ans,end($special_item)+$this->dfs($price,$special,$needs_temp));
            }
        }
        $this->map[$needs_key] = $ans;
        return $ans;
    }

    function getMapKey($needs){
        $ans = '';
        foreach($needs as $count){
            $ans .= $count.':';
        }
        return $ans;
    }

	function test(){
		echo $this->shoppingOffers( [2,5], [[3,0,5],[1,2,10]], [3,2]).PHP_EOL;
	}
}

(new Solution())->test();