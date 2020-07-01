<?php

require_once 'base\AlgorithmBase.php';

//有效括号的嵌套深度-升降维度+维度奇偶分配
class Solution extends \algorithm\base\AlgorithmBase
{
	//升降维度
    function maxDepthAfterSplit1($seq) {
		$length = strlen($seq);
		$a = $b = 0;
		$res = [];
		for($i = 0;$i < $length;$i++){
			if($seq{$i} == '('){
				if($a < $b){
					$a++;
					$res[] = 0;
				}else{
					$b++;
					$res[] = 1;
				}
			}else{
				if($a > $b){
					$a--;
					$res[] = 0;
				}else{
					$b--;
					$res[] = 1;
				}
			}
		}
		
		return $res;
	}
	
	//维度奇偶分配
	 function maxDepthAfterSplit($seq) {
		$dep = 0;
		$length = strlen($seq);
		$res = [];
		for($i= 0;$i < $length;$i++){
			if($seq{$i} == '('){
				$dep++;
				$res[] = $dep % 2;
			}else{
				$res[] = $dep-- % 2;
			}
		}
		
		return $res;
	 }
	
	function test(){
		print_r($this->maxDepthAfterSplit("(()())"));
	}
}

(new Solution())->test();