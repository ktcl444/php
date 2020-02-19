<?php

require 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    public function productExceptSelf($nums)
    {
        $result = [1];
        $length = count($nums);
//        $mapping = [];
//        $mapping_asc = [];
//        $length = count($nums);
//        $temp = 1;
//        $temp_asc = 1;
//        for ($i = $length - 1; $i > 0; $i--) {
//            $temp = $temp * $nums[$i];
//            $mapping[$i] = $temp;
//            $asc = $length - $i - 1;
//            $temp_asc = $temp_asc * $nums[$asc];
//            $mapping_asc[$asc] = $temp_asc;
//        }
//        $mapping_asc[-1] = 1;
//        $mapping[$length] = 1;

        $left = 1;
        $right = 1;
        for ($i = 0; $i < $length; $i++) {
            $result[$i] = (array_key_exists($i, $result) ? $result[$i] : 1) * $left;
            $left *= $nums[$i];

            $asc = $length - $i - 1;
            $result[$asc] = (array_key_exists($asc, $result) ? $result[$asc] : 1) * $right;
            $right *= $nums[$asc];
        }

        ksort($result);
        return $result;
    }

    function test()
    {
        print_r($this->productExceptSelf([1, 2, 3, 4]));
    }
}

(new Solution())->test();