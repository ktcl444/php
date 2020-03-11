<?php

require 'base\AlgorithmBase.php';


class Solution extends \algorithm\base\AlgorithmBase
{
    function maxProfit($prices)
    {
        $dp = [];
        $dp[0] = 0; //不持有股票
        $dp[1] = -$prices[0];//持有股票
        $dp[2] = 0;//冷冻期
        $pre_cash = $dp[0];
        $pre_stock = $dp[1];
        for ($i = 1; $i < count($prices); $i++) {
            $dp[0] = max($pre_cash, $pre_stock + $prices[$i]);
            $dp[1] = max($pre_stock, $dp[2] - $prices[$i]);
            $dp[2] = $pre_cash;

            $pre_cash = $dp[0];
            $pre_stock = $dp[1];
        }
        return max($dp[0], $dp[2]);
    }

    function test()
    {
        print_r($this->maxProfit([1, 2, 3, 0, 2]));
        print_r($this->maxProfit([1, 2, 4]));
        print_r($this->maxProfit([1, 2, 1, 0, 1, 2]));
    }
}

(new Solution())->test();