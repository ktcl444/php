<?php

class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val)
    {
        $this->val = $val;
    }
}


/**
 * @param ListNode $l1
 * @param ListNode $l2
 * @return ListNode
 */
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
    $head = new ListNode(0);
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

    $temp->next = is_null($l1)?$l2:$l1;

    return $head->next;
    #endregion
}

// 1-2-4 1-3-4
$root1 = new ListNode(1);
$node1_2 = new ListNode(2);
$node1_2->next = new ListNode(4);
$root1->next = $node1_2;

$root2 = new ListNode(1);
$node2_2 = new ListNode(3);
$node2_2->next = new ListNode(4);
$root2->next = $node2_2;

print_r(mergeTwoLists($root1, $root2));

$root1 = new ListNode(1);
$root2 = null;

print_r(mergeTwoLists($root1, $root2));