<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    private $max_length = 0;

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function diameterOfBinaryTree($root)
    {
        #region 深度遍历
        if (is_null($root)) return 0;
        $this->getNodeDeep($root);
        return $this->max_length;
        #endregion

        #region 迭代
//        if (is_null($root)) return 0;
//        $root_list = [$root];
//        while (!empty($root_list)) {
//            $node = array_pop($root_list);
//            $left_length = $this->getNodeDeep($node->left);
//            $right_length = $this->getNodeDeep($node->right);
//            $length = $left_length + $right_length;
//            $this->max_length = max($length, $this->max_length);
//            !is_null($node->left) && array_push($root_list, $node->left);
//            !is_null($node->right) && array_push($root_list, $node->right);
//        }
//
//        return $this->max_length;
        #endregion
    }

    private function getNodeDeep($root)
    {
        if (is_null($root)) {
            return 0;
        }
        $left = $this->getNodeDeep($root->left);
        $right = $this->getNodeDeep($root->right);
        $this->max_length = max($this->max_length, $left + $right);
        return max($left, $right) + 1;
//        $deep = 1;
//        $stack = [[$root, $deep]];
//        while (!empty($stack)) {
//            $node = array_shift($stack);
//            if (is_null($node[0])) continue;
//            $deep = max($deep, $node[1]);
//            if (!is_null($node[0]->left))
//                array_push($stack, [$node[0]->left, $deep + 1]);
//            if (!is_null($node[0]->right))
//                array_push($stack, [$node[0]->right, $deep + 1]);
//        }
//        return $deep;
    }

    function test()
    {
        echo $this->diameterOfBinaryTree(self::convertArrayToTree([1])) . PHP_EOL;
        echo $this->diameterOfBinaryTree(self::convertArrayToTree([1, 2, 3, 4, 5, null, null])) . PHP_EOL;
        echo $this->diameterOfBinaryTree(self::convertArrayToTree([4, -7, -3, null, null, -9, -3, 9, -7, -4, null, 6, null, -6, -6, null, null, 0, 6, 5, null, 9, null, null, -1, -4, null, null, null, -2])) . PHP_EOL;


    }
}

(new Solution())->test();