<?php

require_once 'base\AlgorithmBase.php';

//罗马数字转整形 把一个小值放在大值的左边，就是做减法，否则为加法
class Solution extends \algorithm\base\AlgorithmBase
{
	private $mapping = [
		'I'=>1,
		'V'=>5,
		'X'=>10,
		'L'=>50,
		'C'=>100,
		'D'=>500,
		'M'=>1000,	
	];
	private $special = [
		'I' =>[
			'V'=>4,
			'X'=>9
		],
		'X' =>[
			'L'=>40,
			'C'=>90
		],
		'C' =>[
			'D'=>400,
			'M'=>900
		]
	];
	
	#region 映射
	function romanToInt2($s) {
		$result = 0;
		$length = strlen($s);
		for($i = 0;$i < $length;$i++){
			$char = substr($s,$i,1);
			$value =$this->mapping[$char];
			if($i + 1 < $length && array_key_exists($char,$this->special)){
				$next = substr($s,$i+1,1);
				if(array_key_exists($next,$this->special[$char])){
					$value = $this->special[$char][$next];
					$i++;
				}
			}
			$result += $value;
		}
		return $result;
	}
	#endregion
	
	#region 加减
	function romanToInt($s){
		$result = 0;
		$length = strlen($s);
		$pre = $this->mapping[substr($s,0,1)];
		for($i = 1;$i < $length;$i++){
			$char = substr($s,$i,1);
			$value =$this->mapping[$char];
			if($pre < $value)
				$result -= $pre;
			else
				$result += $pre;
			$pre = $value;
		}
		$result += $pre;
		return $result;
	}
	#endregion
	
	function test(){
		echo $this->romanToInt('III').PHP_EOL;
		echo $this->romanToInt('IV').PHP_EOL;
		echo $this->romanToInt('IX').PHP_EOL;
		echo $this->romanToInt('LVIII').PHP_EOL;
		echo $this->romanToInt('MCMXCIV').PHP_EOL;
	}
}

(new Solution())->test();