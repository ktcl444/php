<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	
/* 		dp(i, j)=min(dp(i−1, j), dp(i−1, j−1), dp(i, j−1))+1
		在前面的动态规划解法中，计算 i行（row）的 dp 方法中，我们只使用了上一个元素和第 (i-1)行，因此我们不需要二维 dp 矩阵，因为一维 dp 足以满足此要求。

	我们扫描一行原始矩阵元素时，我们根据公式：dp[j]=min(dp[j-1],dp[j],prev)更新数组 dp，其中 prev 指的是上一行的dp[j-1]，对于每一行，我们重复相同过程并在 dp 矩阵中更新元素。 
	prev保存的是与当前元素同一列的上方元素的值，目的是作为下一次判断的左上角位置的值。利用元素覆盖时间差，来减小空间复杂度。
	*/
	#region 动态规划
	function maximalSquare($matrix) {
		if(empty($matrix))return 0;
		$row = count($matrix);
		$col = count($matrix[0]);
		$dp = array_fill(0,$col+1,0);
		$max_sqrt = 0;
		$prev = 0;
		for($i=1;$i<=$row;$i++)
		{
			for($j = 1;$j<=$col;$j++){
				$temp = $dp[$j];
				if($matrix[$i-1][$j-1] == 1)
				{
					$dp[$j] = min(min($dp[$j-1],$dp[$j]),$prev)+1;
					$max_sqrt = max($max_sqrt,$dp[$j]);
				}else
				{
					$dp[$j] = 0;
				}
				$prev = $temp;
			}
		}
		return $max_sqrt * $max_sqrt;
	}
	#endregion
	
	#region 暴力破解dfs
	private $square = 0;
	private $matrix ;
	private $col = 0;
	private $row = 0;
	function maximalSquare2($matrix) {
		if(empty($matrix))return 0;
		$this->row = count($matrix);
		$this->col = count($matrix[0]);
		$this->matrix = $matrix;
		for($i=0;$i<$this->row;$i++)
		{
			for($j=0;$j<$this->col;$j++)
			{
				if($matrix[$i][$j] == 1)
				{
					$this->square = max($this->square,1);
					$this->dfs([$i,$j],[$i+1,$j+1],2);
				}
			}
		}
		
		return $this->square;
    }

	function dfs($start,$end,$sqrt)
	{
		$end_row = $end[0];
		$end_col = $end[1];
		if($end_row >= $this->row || $end_col >= $this->col || $this->matrix[$end_row][$end_col] != 1)
		{
			return;
		}
		if($this->check_square($start,$end)){
			$this->square = max($this->square,$sqrt * $sqrt);
			$this->dfs($start,[$end_row+1,$end_col+1],$sqrt +1);
		}
	}
	
	function check_square($start,$end){
		$col = $end[1];
		for($row = $start[0];$row < $end[0];$row++)
		{
			if($this->matrix[$row][$col]==0)
			{
				return false;
			}
		}
		$row = $end[0];
		for($col = $start[1];$col<$end[1];$col++)
		{
			if($this->matrix[$row][$col]==0)
			{
				return false;
			}
		}
		return true;
	}
	#endregion
	
	function test(){
		echo $this->maximalSquare([
			[1,0,1,1,1],
			[1,0,1,1,1],
			[1,1,1,1,1],
			[1,0,0,1,0]
		]).'平方'.PHP_EOL;
	}
}

(new Solution())->test();