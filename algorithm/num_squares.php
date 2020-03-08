<?php

require 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function numSquares($n)
    {
        $result = array_fill(0, $n, 0);
        for ($i = 1; $i <= $n; $i++) {
            $result[$i] = $i;
            for ($j = 1; $i - $j * $j >= 0; $j++) {
                $result[$i] = min($result[$i], $result[$i - $j * $j] + 1);
            }
        }

        return $result[$n];
    }

    function test()
    {
        print_r($this->numSquares(12));
    }
}

(new Solution())->test();