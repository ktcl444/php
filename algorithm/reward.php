<?php
$arr = array(
    array('id' => 1, 'name' => '特等奖', 'v' => 1),
    array('id' => 2, 'name' => '一等奖', 'v' => 5),
    array('id' => 3, 'name' => '二等奖', 'v' => 10),
    array('id' => 4, 'name' => '三等奖', 'v' => 12),
    array('id' => 5, 'name' => '四等奖', 'v' => 22),
    array('id' => 6, 'name' => '没中奖', 'v' => 50)
);

function get_rand($proArr)
{
    $result = -1;
    // 概率数组的总概率
    $proSum = array_sum($proArr);
    asort($proArr);
    // 概率数组循环
    foreach ($proArr as $k => $v) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $v) {
            $result = $k;
            break;
        } else {
            $proSum -= $v;
        }
    }
    return $result;
}

$proArr = array();
foreach ($arr as $key => $val) {
    $proArr[$key] = $val['v'];
}
for ($i = 0; $i < 100; $i++) {
    echo get_rand($proArr) . PHP_EOL;
}