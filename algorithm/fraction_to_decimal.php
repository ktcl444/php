<?php

require_once 'base\AlgorithmBase.php';

//分数到小数-堆栈
class Solution extends \algorithm\base\AlgorithmBase
{
    function fractionToDecimal($numerator, $denominator) {
		if(($numerator<0 && $denominator > 0)||($numerator > 0 && $denominator < 0)){
			$pre = '-';
			$numerator = -$numerator;
		}else{
			$pre = '';
		}
		$integer = intval($numerator / $denominator);
		$mod = $numerator % $denominator;
		return $pre.($mod == 0 ? $integer : $integer.'.'.$this->helper($mod,$denominator));
    }
	
	function helper($mod,$denominator){
		$mod_list = [$mod=>0];
		$loop_number = -1;
		$stack = [];
		
		while($mod!=0){			
			$new_mod = ($mod * 10) % $denominator;
			$new_integer = intval(($mod * 10) / $denominator);
			
			$stack[] = $new_integer;
			if(array_key_exists($new_mod,$mod_list)){
				$loop_number = $mod_list[$new_mod];
				break;
			}else{
				$mod_list[$new_mod] = count($stack)  ;
				$mod = $new_mod;
			}
		}
		if($loop_number >=0){
			$no_repeated_stack = array_slice($stack,0,$loop_number);
			$repeated_stack = array_slice($stack,$loop_number);
			$result = implode('',$no_repeated_stack).'('.implode('',$repeated_stack).')';
		}else{
			$result = implode('',$stack);
		}

		return $result;
	}

    function test()
    {
        echo($this->fractionToDecimal(-22,2)).PHP_EOL;
        echo($this->fractionToDecimal(-22,-2)).PHP_EOL;
        echo($this->fractionToDecimal(1,6)).PHP_EOL;
        echo($this->fractionToDecimal(2,1)).PHP_EOL;
        echo($this->fractionToDecimal(1,2)).PHP_EOL;
        echo($this->fractionToDecimal(2,3)).PHP_EOL;
		echo($this->fractionToDecimal(11,7)).PHP_EOL; 
    }
}

(new Solution())->test();