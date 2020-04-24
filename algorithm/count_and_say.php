<?php

require_once 'base\AlgorithmBase.php';

//外观数列
class Solution extends \algorithm\base\AlgorithmBase
{
    function countAndSay($n) {
        $result = ['1'];
		for($i = 0;$i < $n - 1;$i++){
			$result[$i+1] = $this->getDescription($result[$i]);
		}
		
		return $result[$n - 1];
    }
	
	function getDescription($s){		
		$pre_num = 1;
		$result = '';
		for($i = 0;$i < strlen($s);$i++){
			if(isset($s[$i+1]) && $s[$i+1] == $s[$i]){
				$pre_num++;
			}else{
				$result .= ($pre_num.$s[$i]);
				$pre_num = 1;
			}
		}
		
		return $result;
	}
	
	function test(){
		echo $this->countAndSay(1).PHP_EOL;
		echo $this->countAndSay(2).PHP_EOL;
		echo $this->countAndSay(3).PHP_EOL;
		echo $this->countAndSay(4).PHP_EOL;
		echo $this->countAndSay(5).PHP_EOL;
		echo $this->countAndSay(6).PHP_EOL;
	}
}

(new Solution())->test();