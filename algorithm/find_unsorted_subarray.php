<?php
require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function findUnsortedSubarray($nums)
    {
        if (is_null($nums)) return 0;
        $length = count($nums);
        #region 双指针+不交换
        $min = PHP_INT_MAX;
        $max = PHP_INT_MIN;
        for ($i = 0, $j = $length - 1; $i < $length - 1, $j > 0; $i++, $j--) {
            if ($nums[$i] > $nums[$i + 1]) {
                $min = min($min, $nums[$i + 1]);
            }
            if ($nums[$j - 1] > $nums[$j]) {
                $max = max($max, $nums[$j - 1]);
            }
        }

        for ($l = 0; $l < $length - 1; $l++) {
            if ($min < $nums[$l]) {
                break;
            }
        }
        for ($r = $length - 1; $r >= 0; $r--) {
            if ($max>$nums[$r] ) {
                break;
            }
        }

        return $r - $l < 0 ? 0 : $r - $l + 1;
        #endregion

        #region 双指针+交换
//        $start_index = PHP_INT_MAX;
//        $end_index = PHP_INT_MIN;
//
//        for ($i = 0, $j = $length - 1; $i < $length - 1, $j > 0; $i++, $j--) {
//            if ($nums[$i] > $nums[$i + 1]) {
//                $start_index = min($start_index, $i);
//                $end_index = max($end_index, $i + 1);
//
//                $temp = $nums[$i + 1];
//                $nums[$i + 1] = $nums[$i];
//                $nums[$i] = $temp;
//            }
//            if ($nums[$j - 1] > $nums[$j]) {
//                $start_index = min($start_index, $j - 1);
//                $end_index = max($end_index, $j);
//
//                $temp = $nums[$j];
//                $nums[$j] = $nums[$j - 1];
//                $nums[$j - 1] = $temp;
//            }
//        }
//
//        return $start_index == PHP_INT_MAX && $end_index == PHP_INT_MIN ? 0 : $end_index - $start_index + 1;
        #endregion
    }

    function test()
    {
        echo $this->findUnsortedSubarray([1, 2, 4, 5, 3]) . PHP_EOL;        //3
        echo $this->findUnsortedSubarray([1, 2, 3, 3, 3]) . PHP_EOL;      //0
        echo $this->findUnsortedSubarray([1, 3, 2, 3, 3]) . PHP_EOL;      //2
        echo $this->findUnsortedSubarray([2, 3, 3, 2]) . PHP_EOL;      //3
        echo $this->findUnsortedSubarray([1, 3, 2, 4, 5]) . PHP_EOL;      //2
        echo $this->findUnsortedSubarray([2, 6, 4, 8, 10, 9, 15]) . PHP_EOL;//5
        echo $this->findUnsortedSubarray([1, 2, 3, 4]) . PHP_EOL;         //0
        echo $this->findUnsortedSubarray([2, 1]) . PHP_EOL;               //2
        echo $this->findUnsortedSubarray([5, 4, 3, 2, 1]) . PHP_EOL;      //5
    }
}

(new Solution())->test();