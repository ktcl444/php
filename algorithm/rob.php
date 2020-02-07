<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function rob($nums)
    {
        if ($nums == null) return 0;
        $pre_pre_num = 0;  // -2
        $pre_num = 0;  // -1
        $length = count($nums);
        for ($i = 0; $i < $length; $i++) {
            $temp = $pre_num;
            $pre_num = max($pre_pre_num + $nums[$i], $pre_num);
            $pre_pre_num = $temp;
        }

        return $pre_num;

//        if ($length == 1) return $nums[0];
//        if ($length == 2) return max($nums[0], $nums[1]);
//        if ($length == 3) return max($nums[0] + $nums[2], max($nums[0], $nums[1]));
        // f(m) = max(f(m-2)+nums[m],f(m-1);
    }

    function test()
    {
        echo $this->rob([1, 2, 3, 1]) . PHP_EOL;
        echo $this->rob([2, 7, 9, 3, 1]) . PHP_EOL;
        echo $this->rob([2, 1, 1, 2]) . PHP_EOL;
    }
}

(new Solution())->test();