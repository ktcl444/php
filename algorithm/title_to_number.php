<?php

require_once 'base\AlgorithmBase.php';

//Excel表列序号
class Solution extends \algorithm\base\AlgorithmBase
{
	private $mapping = [
		'A'=>1,
		'B'=>2,
		'C'=>3,
		'D'=>4,
		'E'=>5,
		'F'=>6,
		'G'=>7,
		'H'=>8,
		'I'=>9,
		'J'=>10,
		'K'=>11,
		'L'=>12,
		'M'=>13,
		'N'=>14,
		'O'=>15,
		'P'=>16,
		'Q'=>17,
		'R'=>18,
		'S'=>19,
		'T'=>20,
		'U'=>21,
		'V'=>22,
		'W'=>23,
		'X'=>24,
		'Y'=>25,
		'Z'=>26
	];
	
    function titleToNumber($s) {
		$length = strlen($s);
		if($length == 0)return 0;
		$result = 0;
		$index = 0;
		while($index < $length){
			$char = substr($s,$index,1);
			$result = $result * 26 + $this->mapping[$char];
			$index++;
		}
		return $result;
    }
	
	function test(){
		echo $this->titleToNumber('A').PHP_EOL;
		echo $this->titleToNumber('AB').PHP_EOL;
		echo $this->titleToNumber('ZY').PHP_EOL;
	}
}

(new Solution())->test();