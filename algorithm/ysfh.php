<?php


/***
 * @param $n int 总人数
 * @param $m int 报数
 * @return int
 */
 //有 f(n, m) = (m % n + x) % n = (m + x) % n
/*  f(n,m)={ 	0 					n=1	
			[f(n−1,m)+m]%n		n>1 */
function test($n, $m)
{
    $res = 0;
	for($i = 2;$i <= $n;$i++){
		$res = ($res + $m)% $i;
	}
	
	return $res;
}
​	
function test1($sum, $value, $n)
{
    if ($n == 1) {
        return ($sum + $value - 1) % $sum;
    } else {
        return (test($sum - 1, $value, $n - 1) + $value) % $sum;
    }
}

echo test(10, 4, 10); //10个人 第4个跳海 第10轮跳海的人最开始是多少号