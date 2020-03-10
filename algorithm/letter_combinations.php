<?php

require 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    private $mapping = [
        2 => ['a', 'b', 'c'],
        3 => ['d', 'e', 'f'],
        4 => ['g', 'h', 'i'],
        5 => ['j', 'k', 'l'],
        6 => ['m', 'n', 'o'],
        7 => ['p', 'q', 'r', 's'],
        8 => ['t', 'u', 'v'],
        9 => ['w', 'x', 'y', 'z'],
    ];

    function letterCombinations($digits)
    {
        $result = [];
        $length = strlen($digits);
        for ($i = 0; $i < $length; $i++) {
            $char = substr($digits, $i, 1);
            $mapping = $this->mapping[$char];
            if (empty($result)) {
                $result = $mapping;
            } else {
                $temp = [];
                foreach ($mapping as $item) {
                    foreach ($result as $string) {
                        $new_string = $string . $item;
                        $temp[] = $new_string;
                    }
                }
                $result = $temp;
            }
        }

        return $result;
    }

    #region 递归
    function letterCombinations2($digits)
    {
        $arr[2] = 'abc';
        $arr[3] = 'def';
        $arr[4] = 'ghi';
        $arr[5] = 'jkl';
        $arr[6] = 'mno';
        $arr[7] = 'pqrs';
        $arr[8] = 'tuv';
        $arr[9] = 'wxyz';
        $arrD = str_split($digits, 1);
        $len = count($arrD);
        foreach ($arrD as $d) {
            $info[$d] = str_split($arr[$d], 1);
            $arrContent[] = $info[$d];
        }
        if (empty($digits)) {
            return array();
        } elseif ($len == 1) {
            return $arrContent[0];
        }
        return $this->calc($arrContent, 0, $len);
    }

    function calc($arrContent, $index, $len)
    {
        $ret = array();
        $arr1 = $arrContent[$index];
        if ($index < $len - 2) {
            $arr2 = $this->calc($arrContent, $index + 1, $len);
        } else {
            $arr2 = $arrContent[$len - 1];
        }
        foreach ($arr1 as $c1) {
            foreach ($arr2 as $c2) {
                $ret[] = $c1 . $c2;
            }
        }
        return $ret;
    }

    #endregion

    function test()
    {
        print_r($this->letterCombinations('23'));
    }
}

(new Solution())->test();