<?php

class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    function __construct($value)
    {
        $this->val = $value;
    }
}

class Solution
{
    private $sum = 0;

    #region 递归
//    function convertBST($root)
//    {
//        if ($root != null) {
//            $this->convertBST($root->right);
//            $this->sum += $root->val;
//            $root->val = $this->sum;
//            $this->convertBST($root->left);
//        }
//        return $root;
//    }
    #endregion

    #region 迭代
    function convertBST($root)
    {
        $sum = 0;
        $temp = $root;
        $stack = [];
        while ($temp != null || !empty($stack)) {
            while ($temp != null) {
                array_push($stack, $temp);
                $temp = $temp->right;
            }

            $temp = array_pop($stack);
            $sum += $temp->val;
            $temp->val = $sum;

            $temp = $temp->left;
        }

        return $root;
    }
    #endregion

    #region 递归-笨
//    private $node_val_mapping = [];
//
//    function convertBST($root)
//    {
//        $this->setNodeValue($root);
//        return $root;
//    }
//
//    function setNodeValue(&$node, $parent_val = 0)
//    {
//        if (is_null($node)) {
//            return;
//        }
//        $right_val = $this->getNodeValue($node->right);
//        $node->val += intval($right_val + $parent_val);
//        $this->setNodeValue($node->right, $parent_val );
//        $this->setNodeValue($node->left, $node->val);
//    }
//
//    function getNodeValue($node)
//    {
//        if (is_null($node))
//            return 0;
//        if (array_key_exists($node->val, $this->node_val_mapping)) {
//            return $this->node_val_mapping[$node->val];
//        }
//        $val = intval($this->getNodeValue($node->left) + $node->val + $this->getNodeValue($node->right));
//        $this->node_val_mapping[$node->val] = $val;
//        return $val;
//    }

    #endregion

}

//[2,0,3,-4,1]
$root = new TreeNode(5);
$root->left = new TreeNode(2);
$root->right = new TreeNode(13);

print_r((new Solution())->convertBST($root));

$root = new TreeNode(2);

$left_node = new TreeNode(0);
$left_node->left = new TreeNode(-4);
$left_node->right = new TreeNode(1);

$right_node = new TreeNode(3);

$root->left = $left_node;
$root->right = $right_node;

print_r((new Solution())->convertBST($root));