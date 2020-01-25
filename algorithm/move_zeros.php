<?php

function moveZeroes(&$nums)
{
    #region 遍历-截断-添加
//    $length = count($nums);
//    for($i = 0;$i<$length;$i++)
//    {
//        if($nums[$i] == 0)
//        {
//            array_splice($nums,$i,1);
//            array_push($nums,0);
//            $i--;
//            $length--;
//        }
//    }
    #endregion

    #region 遍历-移动-添加
//    $length = count($nums);
//    $zero_count = 0;
//    for ($i = 0; $i < $length; $i++) {
//        if ($nums[$i] == 0) {
//            $zero_count++;
//        } else {
//            if ($zero_count > 0) {
//                $nums[$i - $zero_count] = $nums[$i];
//            }
//        }
//    }
//    $start_index = $length-$zero_count;
//    for($j = 0;$j<$zero_count;$j++)
//    {
//        $nums[$start_index + $j] = 0;
//    }
    #endregion

    #region 双指针交换
    $length = count($nums);
    for ($last_no_zero = 0, $cur = 0; $cur < $length; $cur++) {
        if ($nums[$cur] != 0) {
            if ($last_no_zero != $cur) {
                //交换
                $temp = $nums[$cur];
                $nums[$cur] = $nums[$last_no_zero];
                $nums[$last_no_zero] = $temp;
            }

            $last_no_zero++;
        }
    }
    #endregion
}

$a = [0, 1, 0, 3, 12];
moveZeroes($a);
print_r($a);