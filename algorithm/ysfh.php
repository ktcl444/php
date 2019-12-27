<?php


/***
 * @param $sum int 总人数
 * @param $value int 报数
 * @param $n int 轮次
 * @return int
 */
function test($sum, $value, $n)
{
    if ($n == 1) {
        return ($sum + $value - 1) % $sum;
    } else {
        return (test($sum - 1, $value, $n - 1) + $value) % $sum;
    }
}

echo test(10, 4, 10); //10个人 第4个跳海 第10轮跳海的人最开始是多少号