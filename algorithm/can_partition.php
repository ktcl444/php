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

		foreach($nums as $num){
			for($j=$target;$num<=$j ;$j--){
				//1、不选择 nums[i]，如果在 [0, i - 1] 这个子区间内已经有一部分元素，使得它们的和为 j ，那么 dp[i][j] = true；
				//2、选择 nums[i]，如果在 [0, i - 1] 这个子区间内就得找到一部分元素，使得它们的和为 j - nums[i]。
				//dp[i][j] = dp[i - 1][j] or dp[i - 1][j - nums[i]]
				//滚动数组
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