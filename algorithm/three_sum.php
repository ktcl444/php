<?php

require_once 'base\AlgorithmBase.php';
//三数之和-双指针排序+暴力
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 暴力
	private $mapping = [];
	private $minus_mapping = [];
    function threeSum2($nums) {
        $length = count($nums);
		if($length < 3) return [];
		sort($nums);
		$result = [];
		for($i = 0;$i < $length - 2;$i ++)
		{
			for($j = $i + 1;$j < $length -1;$j ++)
			{
				for($k = $j + 1;$k < $length;$k ++)
				{
					if($nums[$i] + $nums[$j] + $nums[$k] == 0)
					{
						$this->insert($result,$nums[$i],$nums[$j],$nums[$k]);
					}
				}
			}
		}
		
		return $result;
    }
	
	function insert(&$result,$first,$second,$third)
	{
		$temp = [$first,$second,$third];
		if(!in_array($temp,$result))
		{
			$result[] = $temp;
		}
	}
	#endregion
	
/* 	特判，对于数组长度 nn，如果数组为 nullnull 或者数组长度小于 33，返回 [][]。
	对数组进行排序。
	遍历排序后数组：
		若 nums[i]>0nums[i]>0：因为已经排序好，所以后面不可能有三个数加和等于 00，直接返回结果。
		对于重复元素：跳过，避免出现重复解
		令左指针 L=i+1L=i+1，右指针 R=n-1R=n−1，当 L<RL<R 时，执行循环：
			当 nums[i]+nums[L]+nums[R]==0nums[i]+nums[L]+nums[R]==0，执行循环，判断左界和右界是否和下一位置重复，去除重复解。并同时将 L,RL,R 移到下一位置，寻找新的解
			若和大于 0，说明 nums[R] 太大，R 左移
			若和小于 0，说明 nums[L] 太小，L 右移 */
	function threeSum($nums)
	{
		$length = count($nums);
		if($length < 3) return [];
		sort($nums);
		$result = [];
		for($i=0;$i<$length;$i++)
		{
			if($nums[0] > 0)return [];
			if($i > 0 && $nums[$i] == $nums[$i -1])
				continue;
			$l = $i + 1;
			$r = $length - 1;
			while($l < $r)
			{
				$plus = $nums[$i] + $nums[$l] + $nums[$r];
				if($plus == 0)
				{
					$result[] = [$nums[$i] , $nums[$l] , $nums[$r]];
					while($l < $r && $nums[$l] == $nums[$l + 1])
						$l ++;
					while($l < $r && $nums[$r] == $nums[$r - 1])
						$r --;
					$l++;
					$r--;
				}else if($plus > 0)
				{
					$r--;
				}else
				{
					$l++;
				}
			}
		}
		return $result;	
	}


    function test()
    { 
		//-4 -1 -1 0 1 2
		print_r($this->threeSum([-1, 0, 1, 2, -1, -4]));
    }
}

(new Solution())->test();