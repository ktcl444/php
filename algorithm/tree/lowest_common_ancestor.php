<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    #region 父指针
    public function LowestCommonAncestor(TreeNode $root, TreeNode $p, TreeNode $q)
    {
        $node_list = [];
        $parent_mapping = [];

        $parent_mapping[$root->val] = null;
        $node_list[] = $root;

        while (!array_key_exists($p->val, $parent_mapping) || !array_key_exists($q->val, $parent_mapping)) {
            $node = array_pop($node_list);
            if ($node->left != null) {
                $parent_mapping[$node->left->val] = $node;
                array_push($node_list, $node->left);
            }
            if ($node->right != null) {
                $parent_mapping[$node->right->val] = $node;
                array_push($node_list, $node->right);
            }
        }

        $parent_list = [];
        while ($p != null) {
            array_push($parent_list, $p->val);
            $p = $parent_mapping[$p->val];
        }

        while (!in_array($q->val, $parent_list)) {
            $q = $parent_mapping[$q->val];
        }

        return $q;
    }
    #endregion

    #region 递归
//    private $node;
//
//    public function __construct()
//    {
//        $this->node = null;
//    }
//
//    private function recurseTree($root, $p, $q)
//    {
//        if ($root == null) return 0;
//        $left = $this->recurseTree($root->left, $p, $q);
//        $right = $this->recurseTree($root->right, $p, $q);
//        $mid = ($root->val == $p->val || $root->val == $q->val) ? 1 : 0;
//        if (($left + $right + $mid) >= 2) {
//            $this->node = $root;
//        }
//
//        return ($left + $right + $mid) > 0 ? 1 : 0;
//    }
//
//    public function LowestCommonAncestor(TreeNode $root, TreeNode $p, TreeNode $q)
//    {
//        $this->recurseTree($root, $p, $q);
//        return $this->node;
//    }
    #endregion
    #region 路徑
//    public function LowestCommonAncestor(TreeNode $root, TreeNode $p, TreeNode $q)
//    {
//        $p_path = $this->getPath($root, $p);
//        $q_path = $this->getPath($root, $q);
//        $p_length = count($p_path);
//        $q_length = count($q_path);
//        $p = 0;
//        $q = 0;
//        while ($p < $p_length && $q < $q_length) {
//            if ($p_path[$p] == $q_path[$q]) {
//                return $p_path[$p];
//            }
//            $q++;
//            if ($q == $q_length) {
//                $p++;
//                $q = 0;
//            }
//        }
//
//        return -1;
//    }
//
//    private function getPath(TreeNode $root, TreeNode $node)
//    {
//        if ($root->val == $node->val) {
//            return [$root->val];
//        }
//
//        $left = is_null($root->left) ? [] : $this->getPath($root->left, $node);
//        if (!empty($left)) {
//            array_push($left, $root->val);
//            return $left;
//        }
//        $right = is_null($root->right) ? [] : $this->getPath($root->right, $node);
//        if (!empty($right)) {
//            array_push($right, $root->val);
//            return $right;
//        }
//
//        return [];
//    }
    #endregion

    function test()
    {
        $root = self::convertArrayToTree([3, 5, 1, 6, 2, 0, 8, null, null, 7, 4]);
//        print_r($this->getPath($root, new TreeNode(5)));
//        print_r($this->getPath($root, new TreeNode(1)));
        print_r($this->LowestCommonAncestor($root, new TreeNode(5), new TreeNode(1))->val);
        print_r($this->LowestCommonAncestor($root, new TreeNode(5), new TreeNode(4))->val);
    }
}

(new Solution())->test();