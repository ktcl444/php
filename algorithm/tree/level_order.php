<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';


class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    #region 递归
//    private $order_mapping = [];
//
//    function levelOrder($root)
//    {
//        $this->order($root, 0);
//        return $this->order_mapping;
//    }
//
//    private function order($node, $level)
//    {
//        if (is_null($node)) return;
//        $order = array_key_exists($level, $this->order_mapping) ? $this->order_mapping[$level] : [];
//        array_push($order, $node->val);
//        $this->order_mapping[$level] = $order;
//        $this->order($node->left, $level + 1);
//        $this->order($node->right, $level + 1);
//    }
    #endregion

    #region 迭代
    function levelOrder($root)
    {
        $order_mapping = [];
        if (is_null($root)) return $order_mapping;
        $list = [$root];
        $level = 0;
        while (!empty($list)) {
            $order = [];
            $length = count($list);
            for ($i = 0; $i < $length; $i++) {
                $node = array_shift($list);
                array_push($order, $node->val);
                !is_null($node->left) && array_push($list, $node->left);
                !is_null($node->right) && array_push($list, $node->right);
            }
            $order_mapping[$level++] = $order;
        }
        return $order_mapping;
    }

    #endregion

    function test()
    {
        print_r($this->levelOrder(self::convertArrayToTree([3, 9, 20, null, null, 15, 7])));
    }
}

(new Solution())->test();