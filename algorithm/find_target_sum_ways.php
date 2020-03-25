<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	#region 动态规划
    function findTargetSumWays($nums, $S) {
/* 		// 状态转移方程
		dp[i][j] = dp[i - 1][j - nums[i]] + dp[i - 1][j + nums[i]]

		// 改写成 当dp[i][j] = 0
		dp[i][j] = dp[i][j] +dp [i-1][j-nums[i]]
		dp[i][j] = dp[i][j] +dp [i-1][j+nums[i]]

		// 用 j = j - nums[i] 和 j = j + nums[i] 分别代入上面两行代码得到
		dp[i][j - nums[i]] = dp[i][j - nums[i]] + dp[i - 1][j]
		dp[i][j - nums[i]] = dp[i][j - nums[i]] + dp[i - 1][j]

		// 所以
		dp[i][j + nums[i]] += dp[i - 1][j]
		dp[i][j - nums[i]] += dp[i - 1][j]
 */		
 
		$length = count($nums);
		$dp = array_fill(0,2001,0);
		//print_r($dp);
		$dp[$nums[0]+1000] = 1;
		$dp[-$nums[0]+1000] += 1;
		for($i = 1;$i < $length;$i++)
		{
			$next = array_fill(0,2001,0);
			for($sum = -1000;$sum <= 1000;$sum ++)
			{
				if($dp[$sum + 1000] > 0)
				{
					$next[$sum + $nums[$i] + 1000] += $dp[$sum + 1000];
					$next[$sum - $nums[$i] + 1000] += $dp[$sum + 1000];
				}
			}
			$dp = $next;
		}
		return $S > 1000 ? 0 : $dp[$S +1000];
	}
	#endregion
	
	#region 递归
/* 	private $result = 0;
	  function findTargetSumWays1($nums, $S) {
		  $this->cal($nums,0,0,$S);
		  return $this->result;
	  }
	  
	  private function cal($nums,$i,$sum,$target)
	  {
		  if($i == count($nums))
		  {
			  if($sum == $target)
				  $this->result ++;
		  }else
		  {
			  $this->cal($nums,$i+1,$sum + $nums[$i],$target);
			  $this->cal($nums,$i+1,$sum - $nums[$i],$target);
		  }
	  } */
	#endregion


	#region 遍历
/*     function findTargetSumWays2($nums, $S) {
        $sum = 0;
		$length = count($nums);
		for($i = 0;$i < $length;$i++)
		{
			$sum += $nums[$i];
		}
		$temp = $sum - $S;
		if($temp == 0)
		{
			$result = $this->subarraySum($nums,$S);
			return $S == 0 ? $result +1 :$result;
		}
		if($temp > 0)
		{
			if($temp % 2 == 0)
			{
				return $this->subarraySum($nums,$temp / 2);
			}else
			{
				return 0;
			}
		}
		if($temp < 0)
		{
			return 0;
		}
    }

	
	function subarraySum($nums, $k) {
        $sum_mapping = [];
		$sum_mapping[$k] = 0;
		$sum_mapping[$nums[0]]++;
		$dp = [];
		$dp[0] = [$nums[0]];
		$length = count($nums);
		for($i = 1;$i< $length;$i++)
		{
			$cur = $nums[$i];
			$pre = $dp[$i - 1];
			$result = [$cur];
			$sum_mapping[$cur]++;
			foreach($pre as $sum)
			{
				$result[] = $sum;
				
				$sum += $cur;
				$result[] = $sum;
				$sum_mapping[$sum]++;
			}
			$dp[$i]= $result;
		}
		
		return $sum_mapping[$k];
    } */
	#endregion
	
		
	function test(){
		//echo  $this->findTargetSumWays([1],2).PHP_EOL;
		//echo  $this->findTargetSumWays([1,1,1,1,1],3).PHP_EOL;
	echo  $this->findTargetSumWays([0,0,0,0,0,0,0,0,1],1).PHP_EOL;
				//echo  $this->findTargetSumWays([0,35,32,3,4,16,12,25,47,9,14,29,7,26,17,42,21,23,48,18],20).PHP_EOL;
	}
}

(new Solution())->test();