<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    private $result = [];

    function inorderTraversal($root)
    {
        if (is_null($root)) return $this->result;

        #region 基于栈的遍历
        $stack = [];
        $cur = $root;
        while ($cur != null || !empty($stack)) {
            while ($cur != null) {
                array_push($stack, $cur);
                $cur = $cur->left;
            }

            $cur = array_pop($stack);
            array_push($this->result, $cur->val);
            $cur = $cur->right;
        }
        return $this->result;
        #endregion

        #region 迭代
//        $left_temp = [$root];
//        $root_temp = [];
//        while (!empty($left_temp)) {
//            $cur = array_shift($left_temp);
//            if (!is_null($cur->left)) {
//                array_push($left_temp, $cur->left);
//                array_push($root_temp, $cur);
//            } else {
//                array_push($this->result, $cur->val);
//                !is_null($cur->right) && array_push($left_temp, $cur->right);
//                while (empty($left_temp) && !empty($root_temp)) {
//                    $cur_root = array_pop($root_temp);
//                    array_push($this->result, $cur_root->val);
//                    !is_null($cur_root->right) && array_push($left_temp, $cur_root->right);
//                }
//            }
//        }
//
//        return $this->result;
        #endregion

        #region 递归
//        $this->order($root);
//        return $this->result;
        #endregion
    }

    private function order($root)
    {
        if (!is_null($root->left)) {
            $this->inorderTraversal($root->left);
        }
        array_push($this->result, $root->val);
        if (!is_null($root->right)) {
            $this->inorderTraversal($root->right);
        }
    }

    private function init()
    {
        $this->result = [];
    }

    function test()
    {
        print_r($this->inorderTraversal(self::convertArrayToTree([1, 2, 3])));
        $this->init();
        print_r($this->inorderTraversal(self::convertArrayToTree([1, null, 2, 3])));
        $this->init();
        print_r($this->inorderTraversal(self::convertArrayToTree([2, 3, null, 1])));
        $this->init();
        print_r($this->inorderTraversal(self::convertArrayToTree([3, 1, null, null, 2])));
        $this->init();
        print_r($this->inorderTraversal(self::convertArrayToTree([1, 4, 3, 2])));
        $this->init();
        print_r($this->inorderTraversal(self::convertArrayToTree([4, 2, null, 1, 3])));
    }
}

(new Solution())->test();