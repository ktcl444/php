<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    function isSymmetric($root)
    {
        #region 递归
        return $this->is_symmetric($root->left, $root->right);
        #endregion

        #region 迭代
//        $stack = [[$root->left, $root->right]];
//        while (!empty($stack)) {
//            $nodes = array_pop($stack);
//            $left_node = $nodes[0];
//            $right_node = $nodes[1];
//            if ($left_node == null && $right_node == null) {
//                continue;
//            }
//            if (!($left_node != null && $right_node != null)) {
//                return false;
//            }
//            if ($left_node->val != $right_node->val) {
//                return false;
//            }
//            array_push($stack, [$left_node->right, $right_node->left]);
//            array_push($stack, [$left_node->left, $right_node->right]);
//        }
//
//        return empty($stack);
        #endregion
    }

    private function is_symmetric($left_node, $right_node)
    {
        if ($left_node == null && $right_node == null) {
            return true;
        }
        if (!($left_node != null && $right_node != null)) {
            return false;
        }
        if ($left_node->val != $right_node->val) {
            return false;
        }
        $left = $this->is_symmetric($left_node->left, $right_node->right);
        $right = $this->is_symmetric($left_node->right, $right_node->left);
        return $left && $right;
    }


//  1
// / \
// 2   2
/// \ / \
//3  4 4  3
    function test()
    {
        $root = self::convertArrayToTree([1, 2, 2, 3, 4, 4, 3]);
        echo ($this->isSymmetric($root) ? 1 : 0) . PHP_EOL;
        $root = self::convertArrayToTree([1, 2, 2, null, 3, null, 3]);
        echo $this->isSymmetric($root) ? 1 : 0 . PHP_EOL;
        $root = self::convertArrayToTree([1, 0]);
        echo $this->isSymmetric($root) ? 1 : 0 . PHP_EOL;

    }
}

(new Solution())->test();