<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function permute($nums)
    {
        if (empty($nums)) return [];
        $length = count($nums);
        if (count($nums) == 1) return [[$nums[0]]];
        $current = array_pop($nums);
        $pre_result = $this->permute($nums);
        $pre_count = count($pre_result);
        $result = [];
        for ($i = 0; $i < $pre_count; $i++) {
            $pre_num = $pre_result[$i];
            for ($j = 0; $j < $length ; $j++) {
                $temp = $pre_num;
                array_splice($temp, $j, 0, $current);
                array_push($result, $temp);
            }
        }

        return $result;
    }

    function test()
    {
        print_r($this->permute([1, 2,3]));
    }
}

(new Solution())->test();