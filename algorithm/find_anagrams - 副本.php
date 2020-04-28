<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	#region 滑动窗口
	 function findAnagrams($s, $p) {
		$p_array = str_split($p);
		$p_mapping = [];
		foreach($p_array as $c)
		{
			$p_mapping[$c]++;
		}
		$left = 0;
		$right = 0;
		$window = [];
		$match = 0;
		$length = strlen($s);
		$check_length = strlen($p);
		$result = [];
		while($right < $length)
		{
			$char = substr($s,$right,1);
			if(array_key_exists($char,$p_mapping))
			{
				$window[$char]++;
				if($window[$char] == $p_mapping[$char])
				{
					$match++;
				}
			}
			$right++;
			while($match == count($p_mapping))
			{	if($right - $left == $check_length)
				{
					$result[] = $left;
				}
				$char = substr($s,$left,1);
				if(array_key_exists($char,$p_mapping))
				{
					$window[$char] --;
					if($window[$char] < $p_mapping[$char])
					{
						$match --;
					}
				}
				$left ++;
			}
		}
		
		return $result;
	 }
	 #endregion
	
	#region 遍历
	private $check_array = [];
	private $p_mapping = [];
    function findAnagrams2($s, $p) {

		if($check_length == $length && substr($s,0,$check_length) == $p)return [0];
		$this->init_p($p);
		$this->check_array[] = $p;
		$check_length = strlen($p);
		$length = strlen($s);

		$result = [];
		for($i = 0;$i<=$length - $check_length;$i++)
		{
			$check_s = substr($s,$i,$check_length);
			//print_r($check_s);
			if(in_array($check_s,$this->check_array) || $this->check($check_s,$check_length)){
				$result[] = $i;
			}
		}
		//print_r($this->check_array);
		return $result;
    }
	
	private function init_p($p)
	{
		$p_array = str_split($p);
		foreach($p_array as $s)
		{
			if(array_key_exists($s,$this->p_mapping))
			{
				$this->p_mapping[$s]+=1;
			}else
			{
				$this->p_mapping[$s]=1;
			}
		}
	}
	
	private function check($check_s,$check_length)
	{
		$p_array = str_split($check_s);
		$temp = $this->p_mapping;
		foreach($p_array as $s)
		{
			if(!array_key_exists($s,$temp) || $temp[$s]<= 0)
			{
				return false;
			}
			$check_length -- ;
			$temp[$s] -= 1;
		}
		$result = $check_length == 0;
		if($result && !in_array($check_s,$this->check_array))
		{
			$this->check_array[] = $check_s;
		}
		return $result;
	}
	#endregion
	
	function test(){
		print_r( $this->findAnagrams('ababa','ab'));
	}
}

(new Solution())->test();