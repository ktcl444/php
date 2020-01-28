<?php

namespace algorithm\tree\base;
require("TreeNode.php");

class TreeHelper
{
    #region 迭代
    static function convertArrayToTree($a)
    {
        $root = new TreeNode($a[0]);
        $stack = [$root];
        for ($i = 1; $i < count($a); $i++) {
            $temp = array_pop($stack);
            if (is_null($temp->left)) {
                $temp->left = new TreeNode($a[$i]);
                array_push($stack, $temp);
                continue;
            }
            if (is_null($temp->right)) {
                $temp->right = new TreeNode($a[$i]);
                if (is_null($temp->left->val)) {
                    $temp->left = null;
                } else {
                    array_unshift($stack, $temp->left);
                }
                if (is_null($temp->right->val)) {
                    $temp->right = null;
                } else {
                    array_unshift($stack, $temp->right);
                }
                continue;
            }
        }

        return $root;
    }
    #endregion

    #region 遍历
//    static function convertArrayToTree($a)
//    {
//        $root = new TreeNode($a[0]);
//
//        for ($i = 1; $i < count($a); $i++) {
//
//            $node = new TreeNode($a[$i]);
//            self::insert_node($root, $node);
//        }
//
//        return $root;
//    }
//
//    static function insert_node($root, $inode)
//    {
//        #使用树的广度优先遍历顺序取出节点，直到找到第一个左右子节点没满的节点，将待插入节点插入节点左边或右边
//        $queue = array();
//        array_unshift($queue, $root);
//
//        while (!empty($queue)) {
//            $cnode = array_pop($queue);
//            if ($cnode->left == null) {
//                $cnode->left = $inode;
//                break;
//            } else {
//                array_unshift($queue, $cnode->left);
//            }
//            if ($cnode->right == null) {
//                $cnode->right = $inode;
//                break;
//            } else {
//                array_unshift($queue, $cnode->right);
//            }
//        }
//    }
    #endregion
}

//print_r(TreeHelper::convertArrayToTree([0, 1, null]));
//print_r(TreeHelper::convertArrayToTree([0, 1, 2, 3, 4, 5, 6]));
//print_r(TreeHelper::convertArrayToTree([10, 5, -3, 3, 2, null, 11, 3, -2, null, 1]));