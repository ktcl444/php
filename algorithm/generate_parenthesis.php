<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    private $left_bracket = '(';
    private $right_bracket = ')';

    private $result_mapping = [];

    function generateParenthesis($n)
    {
        #region 闭合包
        $result = [];
        if ($n == 0) return [''];

        if (array_key_exists($n, $this->result_mapping)) {
            return $this->result_mapping[$n];
        }

        for ($i = 0; $i < $n; $i++) {
            $left_result = $this->generateParenthesis($i);
            foreach ($left_result as $left) {
                $right_result = $this->generateParenthesis($n - 1 - $i);
                foreach ($right_result as $right) {
                    $result[] = '(' . $left . ')' . $right;
                }
            }
        }
        $this->result_mapping[$n] = $result;
        return $result;
        #endregion


        #region 回溯
//        $result = [];
//        $this->backtrack($result, '', 0, 0, $n);
//        return $result;
        #endregion

        #region 递归+动态规划
//        if ($n <= 0) return [''];
//        if ($n == 1)
//            return ['()'];
//        $pre_brackets = $this->generateParenthesis($n - 1);
//        $pre_length = count($pre_brackets);
//        $result = [];
//        for ($i = 0; $i < $pre_length; $i++) {
//            $pre_bracket = $pre_brackets[$i];
//            $temp = $pre_bracket;
//            $temp_length = strlen($pre_bracket);
//            for ($j = 0; $j <= $temp_length; $j++) {
//                $new_bracket = substr_replace($temp, $this->left_bracket, $j, 0);
//                $k = $j == $temp_length ? $j + 1 : $j + 3;
//                while ($k < $temp_length + 2) {
//                    $temp_new_bracket = $new_bracket;
//                    $temp_new_bracket = substr_replace($temp_new_bracket, $this->right_bracket, $k, 0);
//                    if (!key_exists($temp_new_bracket, $result)) {
//                        $result[$temp_new_bracket] = 1;
//                    }
//                    $k += 2;
//                }
//            }
//        }
//
//        return array_keys($result);
        #endregion
    }

    private function backtrack(&$result, $cur, $open, $close, $max)
    {
        if (strlen($cur) == $max * 2) {
            $result[] = $cur;
            return;
        }

        if ($open < $max) {
            $this->backtrack($result, $cur . '(', $open + 1, $close, $max);
        }
        if ($close < $open) {
            $this->backtrack($result, $cur . ')', $open, $close + 1, $max);
        }
    }

    function test()
    {
        print_r($this->generateParenthesis(3));
    }
}

(new Solution())->test();