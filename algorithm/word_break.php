<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	#region 递归
    function wordBreak2($s, $wordDict) {
		$mapping = array_fill(0,strlen($s),-1);
		return $this->search($s,$wordDict,0,$mapping);
    }
	
	private function search($s,$wordDict,$start,$mapping){
		if($start == strlen($s))
		{
			return true;
		}
		if($mapping[$start]!=-1)
		{
			return $mapping[$start];
		}
		for($end = $start +1 ;$end<=strlen($s);$end++)
		{
			$search = substr($s,$start,$end-$start);
			if(in_array($search,$wordDict) && $this->search($s,$wordDict,$end,$mapping)){
				return $mapping[$start] = 1;
			}
		}
		
		return $mapping[$start] = 0;
	}
	#endregion
	
	#region 动态规划
	function wordBreak1($s, $wordDict) {
		
		$length = strlen($s);
		$dp =array_fill(0,$length+1,0);
		$dp[0] = 1;
		for($i = 1;$i<=$length;$i++)
		{
			for($j=0;$j<$i;$j++)
			{
				$search = substr($s,$j,$i-$j);
				if($dp[$j] && in_array($search,$wordDict))
				{
					$dp[$i] = 1;
					break;
				}
			}
		}
		
		return $dp[$length];
    }
	#endregion
	
	#region 宽度优先搜索
	function wordBreak($s, $wordDict) {
		$queue = [0];
		$length = strlen($s);
		$visited = array_fill(0,$length,0);
		while(!empty($queue))
		{
			$index = array_shift($queue);
			if($visited[$index] == 1)
			{
				continue;
			}
			for($end = $index +1 ;$end<=$length;$end++)
			{
				$search = substr($s,$index,$end-$index);
				if(in_array($search,$wordDict)){
					array_push($queue,$end);
					if($end == $length)
						return true;
				}
			
			}
			$visited[$index] = 1;
		}
		
		return false;
	}
	#endregion

	function test()
    {
		echo $this->wordBreak('a',["a"])? '1':'0';
		echo $this->wordBreak('leetcode',["leet", "code"])? '1':'0';
		echo $this->wordBreak('applepenapple',["apple", "pen"])? '1':'0';
		echo $this->wordBreak('catsandog',["cats", "dog", "sand", "and", "cat"])? '1':'0';
		echo $this->wordBreak('cars',["car", "ca",'rs'])? '1':'0';
		echo $this->wordBreak('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaab',["a","aa","aaa","aaaa","aaaaa","aaaaaa","aaaaaaa","aaaaaaaa","aaaaaaaaa","aaaaaaaaaa"])? '1':'0';
	}

}

(new Solution())->test();