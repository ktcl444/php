<?php
require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function maxSubArray($nums)
    {
        if (is_null($nums)) return 0;
        $length = count($nums);
        if ($length == 1) return $nums[0];

        #region 贪心
//        $sum = $nums[0];
//        $max = $nums[0];
//        for ($i = 1; $i < $length; $i++) {
//            $sum = max($sum+ $nums[$i], $nums[$i]);
//            $max = max($sum, $max);
//        }
        #endregion

        #region 滑动窗口
        $max = $nums[0];
        for ($i = 1; $i < $length; $i++) {
            if ($nums[$i - 1] > 0) $nums[$i] += $nums[$i - 1];
            $max = max($nums[$i], $max);
        }
        #endregion

        #region 分治
//        $max = $this->helper($nums, 0, count($nums) - 1);
        #endregion

        return $max;
    }

    private function helper($nums, $left, $right)
    {
        if ($left == $right) return $nums[$left];

        $p = intval(($left + $right) / 2);
        $left_max = $this->helper($nums, $left, $p);
        $right_max = $this->helper($nums, $p + 1, $right);
        $cross_max = $this->cross_nums($nums, $left, $right, $p);

        return max(max($left_max, $right_max), $cross_max);
    }

    private function cross_nums($nums, $left, $right, $p)
    {
        if ($left == $right) return $nums[$left];

        $left_max = PHP_INT_MIN;
        $sum = 0;
        for ($i = $p; $i >= $left; $i--) {
            $sum += $nums[$i];
            $left_max = max($left_max, $sum);
        }

        $right_max = PHP_INT_MIN;
        $sum = 0;
        for ($i = $p + 1; $i <= $right; $i++) {
            $sum += $nums[$i];
            $right_max = max($right_max, $sum);
        }

        return $left_max + $right_max;
    }

    function test()
    {
        print_r($this->maxSubArray([-2, 1, -3, 4, -1, 2, 1, -5, 4]) . PHP_EOL);
        print_r($this->maxSubArray([-2, -1]));
    }
}

(new Solution())->test();