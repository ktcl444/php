<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    #region 动态规划(顺推法)
    function minPathSum($grid) {
        $depth = count($grid);
        $len = count($grid[0]);

        $dp = $grid;
        for ($i = 1; $i < $depth; $i++) $dp[$i][0] += $dp[$i-1][0];
        for ($i = 1; $i < $len; $i++) $dp[0][$i] += $dp[0][$i-1];

        for ($i = 1; $i < $depth; $i++) {
            for ($j = 1; $j < $len; $j++) {
                $dp[$i][$j] = min($dp[$i-1][$j], $dp[$i][$j-1]) + $grid[$i][$j];
            }
        }
        return $dp[$depth - 1][$len - 1];
    }
    #endregion

    #region 动态规划(逆推法)
    private $mapping = [];

    function minPathSum2($grid)
    {
        if (empty($grid)) return 0;
        $x_length = count($grid);
        $y_length = count($grid[0]);
        $this->initMapping($x_length, $y_length);
        return $this->getPath($x_length - 1, $y_length - 1, $grid);
    }

    private function initMapping($x, $y)
    {
        for ($i = 0; $i < $x; $i++) {
            for ($j = 0; $j < $y; $j++) {
                $this->mapping[$i][$j] = PHP_INT_MAX;
            }
        }
    }

    private function getPath($x, $y, $grid)
    {
        if ($x == 0 && $y == 0) return $grid[0][0];
        if ($this->mapping[$x][$y] != PHP_INT_MAX) return $this->mapping[$x][$y];
        $pre_x_path = PHP_INT_MAX;
        $pre_y_path = PHP_INT_MAX;
        if ($x - 1 >= 0) {
            $pre_x_path = $this->getPath($x - 1, $y, $grid);
        }
        if ($y - 1 >= 0) {
            $pre_y_path = $this->getPath($x, $y - 1, $grid);
        }
        $pre = min($pre_x_path, $pre_y_path);

        $result = $pre + $grid[$x][$y];
        $this->mapping[$x][$y] = $result;
        return $result;
    }
    #endregion

    function test()
    {
        echo $this->minPathSum([
                [1, 3,],
                [1, 5]
            ]) . PHP_EOL;
        echo $this->minPathSum([
                [1, 3, 1],
                [1, 5, 1],
                [4, 2, 1]
            ]) . PHP_EOL;
        echo $this->minPathSum([
                [1, 2, 5],
                [3, 2, 1]
            ]) . PHP_EOL;
        echo $this->minPathSum([
                [7, 1, 3, 5, 8, 9, 9, 2, 1, 9, 0, 8, 3, 1, 6, 6, 9, 5],
                [9, 5, 9, 4, 0, 4, 8, 8, 9, 5, 7, 3, 6, 6, 6, 9, 1, 6],
                [8, 2, 9, 1, 3, 1, 9, 7, 2, 5, 3, 1, 2, 4, 8, 2, 8, 8],
                [6, 7, 9, 8, 4, 8, 3, 0, 4, 0, 9, 6, 6, 0, 0, 5, 1, 4],
                [7, 1, 3, 1, 8, 8, 3, 1, 2, 1, 5, 0, 2, 1, 9, 1, 1, 4],
                [9, 5, 4, 3, 5, 6, 1, 3, 6, 4, 9, 7, 0, 8, 0, 3, 9, 9],
                [1, 4, 2, 5, 8, 7, 7, 0, 0, 7, 1, 2, 1, 2, 7, 7, 7, 4],
                [3, 9, 7, 9, 5, 8, 9, 5, 6, 9, 8, 8, 0, 1, 4, 2, 8, 2],
                [1, 5, 2, 2, 2, 5, 6, 3, 9, 3, 1, 7, 9, 6, 8, 6, 8, 3],
                [5, 7, 8, 3, 8, 8, 3, 9, 9, 8, 1, 9, 2, 5, 4, 7, 7, 7],
                [2, 3, 2, 4, 8, 5, 1, 7, 2, 9, 5, 2, 4, 2, 9, 2, 8, 7],
                [0, 1, 6, 1, 1, 0, 0, 6, 5, 4, 3, 4, 3, 7, 9, 6, 1, 9]
            ]) . PHP_EOL;
    }
}

(new Solution())->test();