<?php

require 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function sortColors(&$nums)
    {
        $length = count($nums);
        $begin = 0;
        $end = $length - 1;
        $cur = 0;
        while ($cur <= $end) {
            if ($nums[$cur] == 0) {
                $temp = $nums[$cur];
                $nums[$cur++] = $nums[$begin];
                $nums[$begin++] = $temp;
            } else {
                if ($nums[$cur] == 2) {
                    $temp = $nums[$cur];
                    $nums[$cur] = $nums[$end];
                    $nums[$end--] = $temp;
                } else {
                    $cur++;
                }
            }
        }
    }

    #region 交换

    function sortColors2(&$nums)
    {
        $length = count($nums);
        $move_2 = 0;
        for ($i = 0; $i < $length - $move_2; $i++) {
            if ($nums[$i] == 0) {
                array_splice($nums, $i, 1);
                array_unshift($nums, 0);
            } else {
                if ($nums[$i] == 2) {
                    array_splice($nums, $i, 1);
                    array_push($nums, 2);
                    $move_2++;
                    $i--;
                }
            }
        }
    }

    #endregion

    function test()
    {
        $nums = [2, 0, 2, 1, 1, 0];
        $this->sortColors($nums);
        print_r($nums);
        $nums = [1, 2, 0, 0];
        $this->sortColors($nums);
        print_r($nums);
        $nums = [2, 0, 2, 1, 1, 0];
        $this->sortColors($nums);
        print_r($nums);
    }
}

(new Solution())->test();