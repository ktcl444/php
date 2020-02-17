<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';
require_once '..\linked_list\base\ListNode.php';

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{

    #region 递归(后序遍历)
    private $pre = null;

    public function flatten($root)
    {
        $this->flatten1($root);
        return $root;
    }

    public function flatten1($root)
    {
        if ($root == null)
            return;
        $this->flatten($root->right);
        $this->flatten($root->left);
        $root->right = $this->pre;
        $root->left = null;
        $this->pre = $root;
    }
    #endregion

    #region (迭代)先序遍历
    function flatten2($root)
    {
        if (is_null($root)) return null;
        $temp = $root;

        while ($temp != null) {
            if ($temp->left == null) {
                $temp = $temp->right;
                continue;
            }
            $left_node = $temp->left;
            $child_right_node = $left_node;
            while (!is_null($child_right_node->right)) {
                $child_right_node = $child_right_node->right;
            }
            $temp->left = null;
            $right_node = $temp->right;
            $temp->right = $left_node;
            $child_right_node->right = $right_node;
            $temp = $left_node;
        }
        return $root;
    }
    #endregion

    function test()
    {
        print_r($this->flatten(self::convertArrayToTree([1, 2, 5, 3, 4, 6])));
    }
}

(new Solution())->test();