<?php

require_once 'base\AlgorithmBase.php';
//戳气球
class Solution extends \algorithm\base\AlgorithmBase
{
	//dp[$left,$right,$i] = 
	//在添加第 i 个气球后能得到的最大金币数为：
	//nums[left] * nums[i] * nums[right] + dp(left, i) + dp(i, right)
	//当left + 1 = right dp[left right] = 0
	//动态规划（自上到下）
	public function maxCoins2($nums)
	{
		array_unshift($nums,1);
		array_push($nums,1);
		$length = count($nums);
		$cache = array_fill(0,$length,array_fill(0,$length,0));
		
		return $this->dp($nums,$cahche,0,$length - 1);
	}
	
	function dp($nums,$cache,$left,$right)
	{
		if($left + 1== $right) return 0;
		if($cache[$left][$right] > 0) return $cache[$left][$right];
		
		$coins = 0;
		for($i = $left + 1;$i < $right;$i++)
		{
			$coins = max($coins,$nums[$left]*$nums[$i]*$nums[$right] + 
			$this->dp($nums,$cache,$left,$i) + $this->dp($nums,$cache,$i,$right));
		}
		$cache[$left][$right] = $coins;
		return $coins;
	}
	
	//动态规划（自底向上）
	function maxCoins($nums)
	{
		array_unshift($nums,1);
		array_push($nums,1);
		$length = count($nums);
		$dp = array_fill(0,$length,array_fill(0,$length,0));
		for($left = $length - 2;$left >= 0;$left --)
		{
			for($right = $left + 2;$right < $length ;$right ++)
			{
				for($i = $left + 1;$i<$right;$i++)
				{
					$dp[$left][$right] = max($dp[$left][$right],
					$nums[$left]*$nums[$i]*$nums[$right]
					+$dp[$left][$i] + $dp[$i][$right]);
				}
			}
		}
		return $dp[0][$length-1];
	}

    function test()
    { 
		//-4 -1 -1 0 1 2
		echo $this->maxCoins([3,1,5,8]).PHP_EOL;
		echo $this->maxCoins([9,76,64,21,97,60]).PHP_EOL;		
    }
}

(new Solution())->test();