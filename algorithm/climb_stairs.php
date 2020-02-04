<?php
require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    private $stairs_mapping = [];

    function climbStairs($n)
    {
        #region 动态规划
        $temp = [];
        $temp[1] = 1;
        $temp[2] = 2;
        for ($i = 3; $i <= $n; $i++) {
            $temp[$i] = $temp[$i - 2] + $temp[$i - 1];
        }

        return $temp[$n];
        #endregion

        #region  递归
//        if ($n == 1 || $n == 2) {
//            return $n;
//        }
//        return $this->getStairs($n - 1) + $this->getStairs($n - 2);
        #endregion
    }

    private function getStairs($n)
    {
        if (array_key_exists($n, $this->stairs_mapping)) {
            $temp = $this->stairs_mapping[$n];
        } else {
            $temp = $this->climbStairs($n);
            $this->stairs_mapping[$n] = $temp;
        }
        return $temp;
    }

    function test()
    {
        echo $this->climbStairs(2) . PHP_EOL;
        echo $this->climbStairs(3) . PHP_EOL;
        echo $this->climbStairs(10) . PHP_EOL;
        echo $this->climbStairs(100) . PHP_EOL;
    }
}

(new Solution())->test();