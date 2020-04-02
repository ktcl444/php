<?php

require_once 'base\AlgorithmBase.php';
//最长回文子串-中间向两边延伸(字母和字母中间的虚拟位置作为中点)
class Solution extends \algorithm\base\AlgorithmBase
{
    function longestPalindrome($s)
    {
		if(empty($s)) return '';
		
        $length = strlen($s);
		$start = 0;
		$end = 0;
        for ($center = 0; $center <= 2 * $length - 1; $center++) {
            $left = $center / 2;
            $right = $left + $center % 2;
            while ($left >= 0 && $right < $length && substr($s, $left, 1) == substr($s, $right, 1)) {
				if($right - $left > $end - $start)
				{
					$start = $left;
					$end = $right;
				}
                $left--;
                $right++;
            }
        }
        return substr($s,$start,$end - $start + 1);
    }

    function test()
    { print_r($this->longestPalindrome('cbbd'));
        //print_r($this->longestPalindrome('abc'));
        //print_r($this->longestPalindrome('aaa'));
    }
}

(new Solution())->test();