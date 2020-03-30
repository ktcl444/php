<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	#region 动态规划(自上而下)
	function coinChange2($coins, $amount) {
		if($amount < 1) return 0;
		$dp = array_fill(0,$amount+1,0);
		return $this->change($coins,$amount,$dp);
	}
	
	function change($coins,$left,$dp)
	{
		if($left < 0) return -1;
		if($left == 0) return 0;
		if($dp[$left] != 0) return $dp[$left];
		$min = PHP_INT_MAX;
		foreach($coins as $coin)
		{
			$result = $this->change($coins,$left - $coin,$dp);
			if($result >=0 && $result < $min)
				$min = $result + 1;
		}
		$dp[$left] = ($min == PHP_INT_MAX) ? -1 : $min;
		return $dp[$left];
	}
	#endregion
	
	#region 动态规划(自下而上)
    function coinChange($coins, $amount) {
		    $length= count($coins);
			$dp = array_fill(0,$amount + 1,PHP_INT_MAX);
			$dp[0] = 0;
			for($i = 1;$i<=$amount;$i++)
			{
				for($j = 0;$j<$length;$j++)
				{
					if($coins[$j] <= $i)
					{
						$dp[$i] = min($dp[$i],$dp[$i - $coins[$j]]+1);
					}
				}
			}
			print_r($dp);
			
			return $dp[$amount] == PHP_INT_MAX ? -1 : $dp[$amount];
			
   }
   #endregion
   
   #region 动态规划
   #endregion
	
	function test(){
		echo $this->coinChange([2],3);
		echo $this->coinChange([1,2,5],11);
		echo $this->coinChange([2,5,10,1],27);
	}
}

(new Solution())->test();