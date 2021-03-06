<?php

require_once 'base\AlgorithmBase.php';

//回文子串-中间向两边延伸(字母和字母中间的虚拟位置作为中点)
class Solution extends \algorithm\base\AlgorithmBase
{
    function countSubstrings($s)
    {
        $result = 0;
        $length = strlen($s);

        for ($center = 0; $center <= 2 * $length - 1; $center++) {
            $left = $center / 2;
            $right = $left + $center % 2;
            while ($left >= 0 && $right < $length && substr($s, $left, 1) == substr($s, $right, 1)) {
                $result++;
                $left--;
                $right++;
            }
        }
        return $result;
    }

    function test()
    {
        print_r($this->countSubstrings('abc'));
        print_r($this->countSubstrings('aaa'));
    }
}

(new Solution())->test();