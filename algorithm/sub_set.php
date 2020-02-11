<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function subsets($nums)
    {
        $result = [[]];
        if (is_null($nums)) return $result;

        #region 迭代
        $length = count($nums);
        for ($i = 0; $i < $length; $i++) {
            $result_length = count($result);
            for ($j = 0; $j < $result_length; $j++) {
                $temp = $result[$j];
                array_push($temp, $nums[$i]);
                array_push($result, $temp);
            }
        }
        return $result;
        #endregion

        #region 递归
//        return array_merge($result, $this->getSubSets($nums));
        #endregion
    }

    private function getSubSets($nums)
    {
        if (count($nums) == 1) {
            return [[current($nums)]];
        }

        $current = array_pop($nums);
        $sub_sets = $this->getSubSets($nums);
        $length = count($sub_sets);
        for ($i = 0; $i < $length; $i++) {
            $temp = $sub_sets[$i];
            array_push($temp, $current);
            array_push($sub_sets, $temp);
        }

        array_push($sub_sets, [$current]);

        return $sub_sets;
    }

    function test()
    {
        print_r($this->getSubSets([1, 2, 3]));
    }
}

(new Solution())->test();