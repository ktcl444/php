<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    private $pre;
    private $in;
    private $in_mapping;
    private $pre_index;

    function buildTree($preorder, $inorder)
    {
        if (empty($preorder) && empty($inorder)) return null;
        $length = count($preorder);
        for ($i = 0; $i < $length; $i++) {
            $this->in_mapping[$inorder[$i]] = $i;
        }
        $this->pre_index = 0;
        $this->pre = $preorder;
        $this->in = $inorder;

        return $this->helper(0, $length);
    }

    private function helper($left, $right)
    {
        if ($left == $right) return null;

        $root_val = $this->pre[$this->pre_index];
        $root = new TreeNode($root_val);

        $index = $this->in_mapping[$root_val];
        $this->pre_index++;
        $root->left = $this->helper($left, $index);
        $root->right = $this->helper($index + 1, $right);
        return $root;
    }

    function test()
    {
        print_r($this->buildTree([3, 9, 20, 15, 7], [9, 3, 15, 20, 7]));
        print_r($this->buildTree([1, 2, 3], [3, 2, 1]));
        print_r($this->buildTree([1, 2, 3], [2, 3, 1]));
    }
}

(new Solution())->test();