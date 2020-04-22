<?php

require_once 'base\AlgorithmBase.php';

//FizzBuzz
class Solution extends \algorithm\base\AlgorithmBase
{
/* 	1. 如果 n 是3的倍数，输出“Fizz”；
	2. 如果 n 是5的倍数，输出“Buzz”；
	3.如果 n 同时是3和5的倍数，输出 “FizzBuzz”。 */
	 function fizzBuzz($n) {
		 $mapping = [
			3=>'Fizz',
			5=>'Buzz'
		 ];
		 $result = [];
		 for($i = 1;$i <= $n;$i++){
			 $string = '';
			 foreach($mapping as $key =>$value){
				 if($i % $key ==0){
					 $string = $string . $value;
				 }
			 }
			 if(empty($string)){
				 $string = ''.$i;
			 }
			 $result[] = $string;
		 }
		 return $result;
	 }
    function fizzBuzz2($n) {
		$result = [];
		for($i = 1;$i <= $n;$i++){
			if($i % 15 ==0){
				$result[] = 'FizzBuzz';
			}else if($i % 5 == 0){
				$result[] = 'Buzz';
			}else if($i % 3 == 0){
				$result[] = 'Fizz';
			}else{
				$result[] = ''.$i;
			}
		}
		return $result;
    }
	
	function test(){
		print_r($this->fizzBuzz(15));
	}
}

(new Solution())->test();