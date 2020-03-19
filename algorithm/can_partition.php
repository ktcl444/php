<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	function canPartition($nums) {
		$sum= 0;
		foreach($nums as $num){
			$sum += $num;
		}
		if($sum % 2== 1)
		{
			return false;
		}
		$length = count($nums);
		$target = $sum / 2;
		$dp = array_fill(0,$target+1,false);
		$dp[0] = true;
/* 		if($nums[0] <= $target)
		{
			$dp[$nums[0]] = true;
		} */
		foreach($nums as $num){
			for($j=$target;$num<=$j ;$j--){
				//if($dp[$target])
				//{
				//	return true;
				//}
				$dp[$j] = $dp[$j] || $dp[$j - $num];
			}
		}
		
		return $dp[$target];
    }
	
	function test()
    {
		echo  $this->canPartition([1,5,11,5]) ? 'true':'false';
		echo  $this->canPartition([1,2,3,5]) ? 'true':'false';
		echo  $this->canPartition([100]) ? 'true':'false';
		echo  $this->canPartition([1,2,5]) ? 'true':'false';
	}
}

(new Solution())->test();