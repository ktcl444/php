<?php
$arr = array(
    array('id' => 1, 'name' => '特等奖', 'v' => 1),
    array('id' => 2, 'name' => '一等奖', 'v' => 5),
    array('id' => 3, 'name' => '二等奖', 'v' => 10),
    array('id' => 4, 'name' => '三等奖', 'v' => 12),
    array('id' => 5, 'name' => '四等奖', 'v' => 22),
    array('id' => 6, 'name' => '没中奖', 'v' => 50)
);

function get_sum($proArr)
{
    $sum = 0;
    foreach ($proArr as $key => $value) {
        $sum += $value['v'];
    }
    return $sum;
}

function get_rand($proArr)
{
    $result = -1;
    // 概率数组的总概率
//    $proSum = array_sum($proArr);
//    asort($proArr);
    $proSum = get_sum($proArr);
    // 概率数组循环
    foreach ($proArr as $k => $value) {
        $v = $value['v'];
        if ($v == 0) {
            continue;
        }
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $v) {
//            echo 'rand:' . $randNum . PHP_EOL;
            $result = $k;
            break;
        } else {
            $proSum -= $v;
        }
    }
    return $result;
}

function update_reward($reward_index, &$reward_array)
{
    $reward_num = $reward_array[$reward_index]['v'];
    if (--$reward_num < 0) {
        echo ($reward_index + 1) . '已经发完' . PHP_EOL;
    }
    $reward_array[$reward_index]['v'] = $reward_num;
}


for ($i = 0; $i < 100; $i++) {
    $reward_index = get_rand($arr);
    update_reward($reward_index, $arr);
    echo ($reward_index + 1) . PHP_EOL;
}