<?php

require_once 'base\AlgorithmBase.php';

// 编辑距离
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 自底向上
	function minDistance2($word1, $word2) {
        $m = strlen($word1);
		$n = strlen($word2);
		if($m*$n == 0)return $m+$n;
			
		$min = 0;
		$dp = [];
		
		for($i = 0;$i<$m +1;$i++)
		{
			$dp[$i][0] = $i;
		}
		for($j=0;$j<$n+1;$j++)
		{
			$dp[0][$j] = $j;
		}
		for($i = 1;$i<$m+1;$i++)
		{
			for($j = 1;$j<$n+1;$j++)
			{
				$left = $dp[$i-1][$j]+1;
				$right = $dp[$i][$j-1]+1;
				$pre = $dp[$i-1][$j-1];
				if(substr($word1,$i-1,1) != substr($word2,$j-1,1))
				{
					$pre++;
				}
				$dp[$i][$j] = min($left,min($right,$pre));
			}
		}
		return $dp[$m][$n];
    }
	#endregion 
	
	#region 自顶向下
	private $w1;
	private $w2;
	private $dp = [];
	function minDistance($word1, $word2) {
		$this->w1  = $word1;
		$this->w2 = $word2;
		return $this->helper(strlen($word1)-1,strlen($word2)-1);
	}
	
	function helper($m,$n)
	{
		if($m == -1)return $n + 1;
		if($n == -1)return $m+1;
		
		if(isset($this->dp[$m][$n]))
		{
			return $this->dp[$m][$n];
		}
		
		if($this->w1[$m] == $this->w2[$n])
		{
			return $this->helper($m-1,$n-1);
		}else
		{			
			$this->dp[$m][$n] = min($this->helper($m-1,$n),$this->helper($m,$n-1), $this->helper($m-1,$n-1))+1;
		}
		
		return $this->dp[$m][$n];
	}
	#endregion
	function test(){
		echo  $this->minDistance('horse','ros').PHP_EOL;
	}
}

(new Solution())->test();