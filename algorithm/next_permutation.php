<?php

require_once 'base\AlgorithmBase.php';

//[字典序下一个排列-降序变升序]
class Solution extends \algorithm\base\AlgorithmBase
{
    function nextPermutation(&$nums) {
       $left = -1;
	   $right  = -1;
	   $length = count($nums);
	   if($length <= 1) return;
	   
	   for($i = $length - 1;$i > 0;$i --)
	   {
		   if($nums[$i] > $nums[$i - 1])
		   {
			   $left = $i - 1;
			   break;
		   }
	   }
	   if($left == -1)
	   {
		   $this->reverse($nums,0,$length-1);
	   }else
	   {
		   for($i = $length - 1;$i > $left;$i--)
		   {
			   if($nums[$i] > $nums[$left])
			   {
				   $right = $i;
				   break;
			   }
		   }
		   if($left != -1 && $right != -1)
		   {
			   $this->swap($nums,$left,$right);
			   $this->reverse($nums,$left+1,$length-1);
		   }else
		   {
			   $this->reverse($nums,0,$length-1);
		   }
	   }
    }
	
	function reverse(&$nums,$left,$right){
		while($left<$right)
		{
			$this->swap($nums,$left,$right);
			$left ++;
			$right --;
		}
	}

	function swap(&$nums,$i,$j){
		$temp = $nums[$i];
		$nums[$i] = $nums[$j];
		$nums[$j] = $temp;
	}
	
	function test(){
		$nums = [1,2,3];
		$this->nextPermutation($nums);
		print_r($nums);
		
		$nums = [3,2,1];
		$this->nextPermutation($nums);
		print_r($nums);
		
				$nums = [1,1,5];
		$this->nextPermutation($nums);
		print_r($nums);
	}
}

(new Solution())->test();