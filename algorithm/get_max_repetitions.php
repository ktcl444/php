<?php

require_once 'base\AlgorithmBase.php';

//统计重复个数
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 循环节
	function getMaxRepetitions($s1, $n1, $s2, $n2) {
		if($n1 == 0)return 0;
		$s1cnt = 0;
		$s2cnt = 0;
		$recall = [];
		$index = 0;
		while(true){
			$s1cnt++;
			for($i =0;$i < strlen($s1);$i++){
				$c = $s1{$i};
				if($s2[$index] == $c){
					$index++;
					if($index == strlen($s2)){
						$s2cnt++;
						$index = 0;
					}
				}
			}
			if($s1cnt == $n1){
				return floor($s2cnt / $n2);
			}
			
			if(array_key_exists($index,$recall)){
				// 前 s1cnt' 个 s1 包含了 s2cnt' 个 s2
				$pre_loop = $recall[$index];
				  // 以后的每 (s1cnt - s1cnt') 个 s1 包含了 (s2cnt - s2cnt') 个 s2
				$in_loop = [$s1cnt - $pre_loop[0],$s2cnt - $pre_loop[1]];
				break;
			}else{
				$recall[$index] = [$s1cnt,$s2cnt];
			}
		} 
		
		$ans = $pre_loop[1] + floor(($n1 - $pre_loop[0])/$in_loop[0]) * $in_loop[1];
		$rest = ($n1 - $pre_loop[0]) % $in_loop[0];
		
		for($j = 0; $j <$rest;$j++){
			for($i =0;$i < strlen($s1);$i++){
				$c = $s1{$i};
				if($s2[$index] == $c){
					$index++;
					if($index == strlen($s2)){
						$ans++;
						$index = 0;
					}
				}
			}
		}
		
		return floor($ans / $n2);
		 
	}
	#endregion
	#region 寻找循环节(失败)
    function getMaxRepetitions1($s1, $n1, $s2, $n2) {
		$test = $this->temp($s1,$s2);
		$gbd1 = $this->gbd($test[0],$n1);
		$gbd2 = $test[1] * ($gbd1 / $test[0]);
		$n2 = $n2 * ($gbd1 / $n1);
		return floor($gbd2 / $n2);
    }

    function getString($s,$n){
        $ans = '';
        while($n> 0){
            $ans.=$s;
            $n--;
        }
        return $ans;
    }

    function checkCanGet($s1,$s2){
        $l1 = strlen($s1);
        $l2 = strlen($s2);
        if($l1 < $l2)
            return 0;
        $l = 0;
        $r= 0;
		$ans = 0;
        while($l < $l1 && $r < $l2){
            if($s1{$l} == $s2{$r}){
                $l++;
                $r++;
				if($r == $l2){
					$ans++;
					$r = 0;
				}
            }else{
                $l++;
            }
        }
        return $ans;
    }
	
	function temp($s1,$s2){
		$l1 = strlen($s1);
		$l2 = strlen($s2);
		$l = 0;
		$r = 0;
		$count1 = 0;
		$count2 = 0;
		while($l < $l1 && $r < $l2){
			if($s1{$l} == $s2{$r}){
                $l++;
                $r++;
            }else{
                $l++;
            }
			if($r == $l2){
				$count2++;
				if($l > 0){
					$r=0;
				}
			}
			if($l == $l1){
				$count1++;
				if($r > 0){
					$l = 0;
				}
			}
		}
		
		return [$count1,$count2];
	}
	#endregion
	
	function test(){
		echo($this->getMaxRepetitions('baba',11,'baab',1)).PHP_EOL;
		echo($this->getMaxRepetitions('bacaba',3,'abacab',1)).PHP_EOL;
	}
}

(new Solution())->test();