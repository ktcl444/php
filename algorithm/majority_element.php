<?php

function majorityElement($nums)
{
    #region hash
//    $length = count($nums);
//    $half = intval($length / 2);
//    $map = [];
//    $result = null;
//    foreach ($nums as $key => $num) {
//        if (array_key_exists($num, $map)) {
//            $map[$num] = ++$map[$num];
//        } else {
//            $map[$num] = 1;
//        }
//        if ($map[$num] > $half) {
//            $result = $num;
//            break;
//        }
//    }
    #endregion


    #region 投票
    $count = 0;
    $result = null;
    foreach ($nums as $num) {
        $count == 0 && $result = $num;
        $count += ($result == $num ? 1 : -1);
    }
    #endregion

    #region 排序
//    $index = intval(count($nums)/2);
//    sort($nums);
//    $result = $nums[$index];
    #endregion

    return $result;
}

echo majorityElement([2, 2, 1, 1, 1, 2, 2]);
