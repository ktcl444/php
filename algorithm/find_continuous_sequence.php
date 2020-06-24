<?php

require_once 'base\AlgorithmBase.php';

//和为s的连续正数序列-等差数列/滑动窗口
class Solution extends \algorithm\base\AlgorithmBase
{   
	#region 等差数列
	//sum = a1 * n + n*(n-1)/2
	//a1 = (sum -  n*(n-1)/2)/n
	function findContinuousSequence($target) {
		$res= [];
        $half = intval($target/2);
		for($i = 2;$i <= $half;$i++){
			$start = $target - $i*($i - 1)/2;
			if($start <= 0){
				break;
			}
			if($start % $i == 0){
				$start = $start / $i;
				array_unshift($res,range($start,$start+$i-1,1));
			}
		}
		
		return $res;
	}
	#endregion

	#region 滑动窗口
	function findContinuousSequence1($target) {
        $res=[];
		$l = 1;
		$r = 2;
		while($l < $r){
			$sum = ($l+$r)*($r-$l+1)/2;
			if($sum == $target){
				array_unshift($res,range($l,$r,1));
				$l++;
			}else if($sum < $target){
				$r++;
			}else{
				$l++;
			}
		}
		
		return $res;
	}
	#endregion

	#region 暴力
	function findContinuousSequence2($target) {
        $half = intval($target/2);
        $res=[];
        for($i = 2;$i < $half;$i++){
            if($i % 2 == 0){
                $t1 = $target / $i;
                $t2 = intval($t1);
                if($t1 != $t2){
                    $floor = floor($t1);
                    $ceil = ceil($t1);
                    if($t1 * 2 == $floor + $ceil && $ceil - $i /2 > 0 ){
                        $temp = [];
                        while(count($temp) < $i / 2){
                            array_unshift($temp,$floor--);
                        }
                        while(count($temp)<$i){
                            array_push($temp,$ceil++);
                        }
                        array_unshift($res,$temp);
                    }
                }
            }else{
                $t1 = $target / $i;
                $t2 = intval($t1);
                if($t1 == $t2 && $t1 - floor($i / 2) > 0){
                    $temp = [$t1];
                    while(count($temp) <= $i / 2){
                        array_unshift($temp,--$t1);
                    }
                    while(count($temp)<$i){
                        array_push($temp,++$t2);
                    }
                    array_unshift($res,$temp);
                }
            }
        }

        return $res;
    }
	#endregion
	
	function test(){
		print_r($this->findContinuousSequence(9));
	}
	
}
(new Solution())->test();