<?php

require 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function rotate(&$matrix)
    {
        if (empty($matrix)) return;
        #region 依次挪动
//        $n = count($matrix);
//        $round = intval($n / 2);
//        for ($i = 0; $i < $round; $i++) {
//            for ($k = 0; $k < ($n - 2 * $i - 1); $k++) {
//                $temp = $matrix[$i][$i];
//                $index = $n - $i - 1;
//                for ($j = $i; $j < $index; $j++) {
//                    $matrix[$j][$i] = $matrix[$j + 1][$i];
//                }
//                for ($j = $i; $j < $index; $j++) {
//                    $matrix[$index][$j] = $matrix[$index][$j + 1];
//                }
//                for ($j = $index; $j > $i; $j--) {
//                    $matrix[$j][$index] = $matrix[$j - 1][$index];
//                }
//                for ($j = $index; $j > $i + 1; $j--) {
//                    $matrix[$i][$j] = $matrix[$i][$j - 1];
//                }
//                $matrix[$i][$i + 1] = $temp;
//            }
//        }
        #endregion

        #region 转置(行转列)+翻转
//        $n = count($matrix);
//        for ($i = 0; $i < $n; $i++) {
//            for ($j = $i; $j < $n; $j++) {
//                $temp = $matrix[$i][$j];
//                $matrix[$i][$j] = $matrix[$j][$i];
//                $matrix[$j][$i] = $temp;
//            }
//        }
//        for ($i = 0; $i < $n; $i++) {
//            for ($j = 0; $j < intval($n / 2); $j++) {
//                $temp = $matrix[$i][$j];
//                $matrix[$i][$j] = $matrix[$i][$n - $j - 1];
//                $matrix[$i][$n - $j - 1] = $temp;
//            }
//        }
        #endregion

        #region 旋转小矩形
        $n = count($matrix);
        for ($i = 0; $i < intval(($n + 1) / 2); $i++) {
            for ($j = 0; $j < intval($n / 2); $j++) {
                $temp = $matrix[$n - 1 - $j][$i];
                $matrix[$n - 1 - $j][$i] = $matrix[$n - 1 - $i][$n - $j - 1];
                $matrix[$n - 1 - $i][$n - $j - 1] = $matrix[$j][$n - 1 - $i];
                $matrix[$j][$n - 1 - $i] = $matrix[$i][$j];
                $matrix[$i][$j] = $temp;
            }
        }
        #endregion
    }

    function test()
    {
//        $matrix = [
//            [1, 2, 3],
//            [4, 5, 6],
//            [7, 8, 9]
//        ];
//        $this->rotate($matrix);
//        print_r($matrix);
//
//        $matrix = [
//            [1, 2, 3, 4],
//            [5, 6, 7, 8],
//            [9, 10, 11, 12],
//            [13, 14, 15, 16],
//        ];
//        $this->rotate($matrix);
//        print_r($matrix);
        $matrix = [
            [2, 29, 20, 26, 16, 28],
            [12, 27, 9, 25, 13, 21],
            [32, 33, 32, 2, 28, 14],
            [13, 14, 32, 27, 22, 26],
            [33, 1, 20, 7, 21, 7],
            [4, 24, 1, 6, 32, 34]
        ];
        $this->rotate($matrix);
        print_r($matrix);
    }
}

(new Solution())->test();