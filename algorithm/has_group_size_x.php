<?php

require_once 'base\AlgorithmBase.php';
//卡牌分组-暴力+最大公约数
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 最大公约数
	 function hasGroupsSizeX($deck) {
		 $mapping = [];
		 foreach($deck as $v){
            $mapping[$v]++;
        }
		
		$g = -1;
		foreach($mapping as  $count){
			if($g == -1){
				$g = $count;
			}else{
				$g = $this->gcd($g,$count);
			}
		}
		
		return $g > 1;
	 }
	 
	 function gcd($m,$n){
		 while($n != 0){
			 $r = $m % $n ;
			 $m = $n ;
			 $n = $r;
		 }
		 
		 return $m;
	 }
	#endregion
	
	#region 暴力
    function hasGroupsSizeX1($deck) {
        $mapping = [];
        foreach($deck as $v){
            $mapping[$v]++;
        }
        $min = min($mapping);

        $i = 2;
        while($i <= $min){
            if($min % $i == 0 && $this->checkGroup($i,$mapping))
                return true;
            $i++;
        }

        return false;
    }

    function checkGroup($min,$mapping){
        foreach($mapping as $count){
            if($count % $min != 0)
                return false;
        }

        return true;
    }
	#endregion

	function test(){
		echo($this->hasGroupsSizeX([1,2,3,4,4,3,2,1])?'1':'0').PHP_EOL;
	}
}

(new Solution())->test();