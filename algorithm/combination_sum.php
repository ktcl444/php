<?php
require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    #region 递归
    private $length = 0;
    private $result = [];
    private $candidates = [];

    function combinationSum($candidates, $target)
    {
        if (empty($candidates)) return [];
        sort($candidates);
        $this->length = count($candidates);
        $this->candidates = $candidates;

        $this->getSum($target, 0, []);

        return $this->result;
    }

    private function getSum($diff, $start, $pre)
    {
        if ($diff == 0) {
            array_push($this->result, $pre);
        } else {
            for ($i = $start; $i < $this->length && $diff - $this->candidates[$i] >= 0; $i++) {
                array_push($pre, $this->candidates[$i]);
                $this->getSum($diff - $this->candidates[$i], $i, $pre);
                array_pop($pre);
            }
        }
    }
    #endregion

    #region 遍历
//    function combinationSum($candidates, $target)
//    {
//        if (empty($candidates)) return [];
//        $sum_mapping = [];
//        $result = [];
//        sort($candidates);
//        foreach ($candidates as $candidate) {
//            $sum = 0;
//            $num_array = [];
//            $cur_array = [];
//            while ($sum < $target) {
//                $sum += $candidate;
//                array_push($num_array, $candidate);
//                if ($sum == $target) {
//                    $result[] = $num_array;
//                    break;
//                }
//                if ($sum > $target) {
//                    break;
//                }
//                $cur_array[$sum] = $num_array;
//                $diff = $target - $sum;
//                if (array_key_exists($diff, $sum_mapping)) {
//                    $sum_array = $sum_mapping[$diff];
//                    foreach ($sum_array as $array) {
//                        $array = array_merge($array, $num_array);
//                        !in_array($array, $result) && array_push($result, $array);
//                    }
//                }
//                $this->mergeMapping($sum_mapping, $sum, $num_array, $target);
//            }
//            foreach ($cur_array as $key => $array) {
//                $this->setMapping($sum_mapping, $key, $array);
//            }
//        }
//
//        return $result;
//    }
//
//    private function setMapping(&$mapping, $sum, $num_array)
//    {
//        if (array_key_exists($sum, $mapping)) {
//            $sum_array = $mapping[$sum];
//            array_push($sum_array, $num_array);
//            $mapping[$sum] = $sum_array;
//        } else {
//            $mapping[$sum] = [$num_array];
//        }
//    }
//
//    private function mergeMapping(&$mapping, $sum, $num_array, $target)
//    {
//        foreach ($mapping as $key => $map) {
//
//            if (($key + $sum) < $target) {
//                foreach ($map as $array) {
//                    $temp = $array;
//                    $temp = array_merge($temp, $num_array);
//                    $this->setMapping($mapping, $key + $sum, $temp);
//                }
//            }
//        }
//    }
    #endregion

    function test()
    {
//        print_r($this->combinationSum([2, 3, 6, 7], 7));
//        print_r($this->combinationSum([2, 3, 5], 8));
        print_r($this->combinationSum([7, 3, 2], 18));
    }
}

(new Solution())->test();