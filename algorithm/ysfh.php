<?php
//function ysfh($num, $no)
//{
//    $p = 0;
//    for ($i = 2; $i <= $num; $i++) {
//        $p = intval($p + $no) % $i;
//    }
//
//    return $p + 1;
//}
//
//echo ysfh(3, 2);

/***
 * @param $sum string 总人数
 * @param $value int 报数
 * @param $n int 轮次
 * @return int
 */
//function ysfdg($sum, $value, $n)
//{
//    if ($n == 1)
//        return (bcadd($sum, $value) - 1) % $sum;
//    else
//        return (ysfdg($sum - 1, $value, $n - 1) + $value) % $sum;
//}
//
//echo ysfdg(10,4,10);


function test($sum, $value, $n)
{
    if ($n == 1) {
        return ($sum + $value - 1) % $sum;
    } else {
        return (test($sum - 1, $value, $n - 1) + $value) % $sum;
    }
}

echo test(10, 4, 10);
?>