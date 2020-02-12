<?php
function singleNumber($nums)
{
    #region 数组
//    $length = count($nums);
//    $temp = [];
//    for ($i = 0; $i < $length; $i++) {
//        $num = $nums[$i];
//        if (in_array($num, $temp)) {
//           unset($temp[array_search($num,$temp)]);
//        } else {
//           array_push($temp,$num);
//        }
//    }
//
//    return current($temp);
    #endregion

    #region hash
//    $length = count($nums);
//    $temp = [];
//    for ($i = 0; $i < $length; $i++) {
//        $num = $nums[$i];
//        if (array_key_exists($num, $temp)) {
//           unset($temp[$num]);
//        } else {
//            $temp[$num] = 1;
//        }
//    }
//
//    return array_keys($temp)[0];
    #endregion

    #region  异或
    $length = count($nums);
    $result = $nums[0];
    for($i = 1; $i < $length; $i++) {
        $result =  $result ^ $nums[$i];
    }

    return $result;
    #endregion

    #region 数学
//    return 2 * array_sum(array_unique($nums)) - array_sum($nums);
    #endregion

}

echo singleNumber([2, 2, 1]);
