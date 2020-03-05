<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    #region 暂存(栈)
    function dailyTemperatures($T)
    {
        $stack = [];
        $length = count($T);
        $result = array_fill(0, $length, 0);
//        for ($i = $length - 1; $i >= 0; $i--) {
//            while ($T[$i] >= $T[$stack[0]] && !empty($stack)  ) {
//                array_shift($stack);
//            }
//            $result[$i] = empty($stack) ? 0 : $stack[0] - $i;
//            array_unshift($stack, $i);
//        }
//        return array_reverse($result);
        for ($i = 0; $i < $length; $i++) {
            while ($T[$i] > $T[end($stack)] && !empty($stack)) {
                $end_index = end($stack);
                $result[array_pop($stack)] = $i - $end_index;
            }
            $stack[] = $i;
        }
        return $result;
    }
    #endregion

    #region 暂存(数组)
    function dailyTemperatures2($T)
    {
        $result = [];
        $mapping = [];
        $length = count($T);
        for ($i = 0; $i < $length; $i++) {
            $result[$i] = 0;
        }
        for ($i = 0; $i <= 100; $i++) {
            $mapping[$i] = PHP_INT_MAX;
        }
        for ($i = $length - 1; $i >= 0; $i--) {
            $warmer_index = PHP_INT_MAX;
            for ($j = $T[$i] + 1; $j <= 100; $j++) {
                if ($mapping[$j] < $warmer_index) {
                    $warmer_index = $mapping[$j];
                }
            }
            if ($warmer_index < PHP_INT_MAX) {
                $result[$i] = $warmer_index - $i;
            }
            $mapping[$T[$i]] = $i;
        }
        return $result;
    }

    #endregion

    function test()
    {
        print_r($this->dailyTemperatures([73, 74, 75, 71, 69, 72, 76, 73]));
    }
}

(new Solution())->test();