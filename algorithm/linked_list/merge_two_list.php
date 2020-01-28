<?php

namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
    function mergeTwoLists($l1, $l2)
    {
        #region 同时遍历
//    $root = null;
//    $list = null;
//    while ($l1 != null || $l2 != null) {
//        if (is_null($l1)) {
//            $min_val = $l2->val;
//            $l2 = $l2->next;
//        } else {
//            if (is_null($l2)) {
//                $min_val = $l1->val;
//                $l1 = $l1->next;
//            } else {
//                if ($l1->val <= $l2->val) {
//                    $min_val = $l1->val;
//                    $l1 = $l1->next;
//                } else {
//                    $min_val = $l2->val;
//                    $l2 = $l2->next;
//                }
//            }
//        }
//
//        if (is_null($root)) {
//            $root = new ListNode($min_val);
//            $list = $root;
//        } else {
//            $list->next = new ListNode($min_val);
//            $list = $list->next;
//        }
//    }
//
//    return $root;
        #endregion

        #region 数组转换
//    $list1 = [];
//    $list2 = [];
//    while ($l1 != null) {
//        $list1[] = $l1->val;
//        $l1 = $l1->next;
//    }
//
//    while ($l2 != null) {
//        $list2[] = $l2->val;
//        $l2 = $l2->next;
//    }
//
//    $list = array_merge($list1, $list2);
//    sort($list);
//
//    $root = null;
//    $node = null;
//    foreach ($list as $key => $value) {
//        if ($root == null) {
//            $root = new ListNode($value) ;
//            $node = $root;
//        } else {
//            $node->next = new ListNode($value);
//            $node = $node->next;
//        }
//    }
//
//    return $root;
        #endregion

        #region 递归
//    if (is_null($l1)) {
//        return $l2;
//    } else if (is_null($l2)) {
//        return $l1;
//    }
//    if ($l1->val < $l2->val) {
//        $l1->next = mergeTwoLists($l1->next,$l2);
//        return $l1;
//    }else
//    {
//        $l2->next = mergeTwoLists($l1,$l2->next);
//        return $l2;
//    }

        #endregion

        #region 迭代
        $head = new \algorithm\linked_list\base\ListNode(0);
        $temp = $head;

        while ($l1 != null && $l2 != null) {
            if ($l1->val < $l2->val) {
                $temp->next = $l1;
                $l1 = $l1->next;
            } else {
                $temp->next = $l2;
                $l2 = $l2->next;
            }
            $temp = $temp->next;
        }

        $temp->next = is_null($l1) ? $l2 : $l1;

        return $head->next;
        #endregion
   }

    function test()
    {
        $l1 = self::convertArrayToLinkedList([1,2,4]);
        $l2 = self::convertArrayToLinkedList([1,3,4]);
        print_r($this->mergeTwoLists($l1,$l2));
    }
}
(new Solution())->test();
