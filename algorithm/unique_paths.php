<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    #region 动态规划(单数组)
    function uniquePaths($m, $n)
    {
        $mapping = [];
        for ($i = 0; $i < $n; $i++) {
            $mapping[] = 1;
        }
        for ($x = 1; $x < $m; $x++) {
            for ($y = 1; $y < $n; $y++) {
                $mapping[$y] += $mapping[$y - 1];
            }
        }

        return $mapping[$n - 1];
    }
    #endregion

    #region 动态规划
//    function uniquePaths($m, $n)
//    {
//        if ($m == 1 && $n == 1) return 1;
//        $mapping = [];
//        $mapping[0][0] = 0;
//        for ($i = 1; $i < $m; $i++) {
//            $mapping[$i][0] = 1;
//        }
//        for ($i = 1; $i < $n; $i++) {
//            $mapping[0][$i] = 1;
//        }
//        for ($x = 1; $x < $m; $x++) {
//            for ($y = 1; $y < $n; $y++) {
//                $mapping[$x][$y] = $mapping[$x - 1][$y] + $mapping[$x][$y - 1];
//            }
//        }
//
//        return $mapping[$m - 1][$n - 1];
//    }
    #endregion

    function test()
    {
        print_r($this->uniquePaths(3, 2));
        print_r($this->uniquePaths(7, 3));
    }
}

(new Solution())->test();