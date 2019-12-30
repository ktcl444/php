<?php
function max_three($a, $b, $c)
{
    return ($a > $b ? $a : $b) > $c ? ($a > $b ? $a : $b) : $c;
}

function min_three($a, $b, $c)
{
    return ($a < $b ? $a : $b) < $c ? ($a < $b ? $a : $b) : $c;
}

function middle_three($a, $b, $c)
{
    return $a > $b ? ($b > $c ? $b : ($a > $c ? $c : $a)) : ($b < $c ? $b : ($a > $c ? $a : $c));
}

function middle_three_2($a, $b, $c)
{
    return ($a > $b && $b > $c) || ($c > $b && $b > $a) ? $b : (($a > $c && $c > $b) || ($b > $c && $c > $a) ? $c : $a);
}

echo max_three(2, 5, 3) . PHP_EOL;
echo min_three(2, 5, 3) . PHP_EOL;
echo middle_three(2, 5, 3) . PHP_EOL;
echo middle_three(5, 2, 3) . PHP_EOL;
echo middle_three(2, 3, 5) . PHP_EOL;
echo middle_three(5, 3, 2) . PHP_EOL;
echo middle_three(3, 5, 2) . PHP_EOL;
echo middle_three(3, 2, 5). PHP_EOL;

echo middle_three_2(2, 5, 3) . PHP_EOL;
echo middle_three_2(5, 2, 3) . PHP_EOL;
echo middle_three_2(2, 3, 5) . PHP_EOL;
echo middle_three_2(5, 3, 2) . PHP_EOL;
echo middle_three_2(3, 5, 2) . PHP_EOL;
echo middle_three_2(3, 2, 5) . PHP_EOL;