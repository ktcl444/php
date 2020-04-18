<?php

require_once 'base\AlgorithmBase.php';

//最长有效括号
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 左右遍历
	function longestValidParentheses($s) {
		$left= 0;
		$right = 0;
		$max = 0;
		for($i=0;$i<strlen($s);$i++){
			$c = $s[$i];
			if($c == '('){
				$left++;
			}else{
				$right++;
			}
			if($left == $right)
			{
				$max = max($max,$left * 2);
			}else if($right > $left){
				$left = 0;
				$right = 0;
			}
		}
		$left = 0;
		$right = 0;
		for($i = strlen($s)-1;$i>=0;$i--)
		{
			$c = $s[$i];
			if($c == '('){
				$left++;
			}else{
				$right++;
			}
			if($left == $right)
			{
				$max = max($max,$left * 2);
			}else if($left > $right){
				$left = 0;
				$right = 0;
			}
		}
		
		return $max;
	}
	#endregion
	#region 栈
	function longestValidParentheses2($s) {
	   $max = 0;
	   $stack = [-1];
	   for($i = 0;$i < strlen($s);$i++)
	   {
		   $c = $s[$i];
		   if($c == '(')
		   {
			   $stack[] = $i;
		   }else
		   {
			   array_pop($stack);
			   if(empty($stack))
			   {
				   $stack[] = $i;
			   }else
			   {
				   $max = max($max,$i - end($stack));
			   }
		   }
	   }
	   
	   return $max;
	}
	#endregion
	
	#region 占位
    function longestValidParentheses3($s) {
		if(empty($s))return 0;
		$max = 0;
		$length = strlen($s);
		$stack = [];
		$left = '(';
		$temp = 0;
		for($i = 0;$i < $length;$i++){
			$char = substr($s,$i,1);
			if($char == $left)
			{
				$stack[] = $i;
			}else
			{
				if(!empty($stack))
				{
					$left_index = array_pop($stack);
					$s[$left_index] = 1;
					$s[$i] = 1;
				}
			}
		}
		for($i = 0;$i < $length;$i++){
			$char = substr($s,$i,1);
			if($char == 1)
			{
				$temp++;
				$max = max($max,$temp);
			}else
			{
				$temp = 0;
			}
		}
		
		return $max;
	}
	#endregion
	
	function test(){
		echo $this->longestValidParentheses('()(()').PHP_EOL;
		echo $this->longestValidParentheses('(()').PHP_EOL;
		echo $this->longestValidParentheses(')()())').PHP_EOL;
	}
}

(new Solution())->test();