<?php

require_once 'base\AlgorithmBase.php';
class Solution extends \algorithm\base\AlgorithmBase
{
    function longestConsecutive($nums) {
		$length = count($nums);
		if($length == 0) return 0;
		
		$mapping = [];
		$max_length = 0;
		
		for($i = 0;$i< $length;$i++)
		{
			$mapping[$nums[$i]] += 1;
		}
		//print_r($mapping);
		foreach($mapping as $num => $value)
		{
			if(!array_key_exists($num - 1,$mapping))
			{
				$temp = 1;
				while(array_key_exists($num++ + 1,$mapping))
				{
					$temp ++ ;
				}
				$max_length = max($max_length,$temp);
			}
		}
		
		return $max_length;
    }
	
    function test()
    { 
		echo $this->longestConsecutive([1,2,0,1]).PHP_EOL;
		echo $this->longestConsecutive([100, 4, 200, 1, 3, 2]).PHP_EOL;
    }
}

(new Solution())->test();