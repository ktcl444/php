<?php

namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

use \algorithm\linked_list\base\ListNode as ListNode;

class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
    public function GetIntersectionNode(ListNode $headA, ListNode $headB): ListNode
    {
        if ($headA == null || $headB == null) {
            return null;
        }

        #region 冒泡遍历
//        while ($headA->next != null) {
//            $point_b = $headB;
//            while ($point_b->next != null) {
//                if ($headA === $point_b) {
//                    return $headA;
//                }
//                $point_b = $point_b->next;
//            }
//            $headA = $headA->next;
//        }
//
//        return $headA;
        #endregion

        #region hash遍历
//        $hash_a = [];
//        while ($headA->next != null) {
//            array_push($hash_a,$headA);
//            $point_b = $headB;
//            while ($point_b->next != null) {
//                if (in_array($point_b,$hash_a)) {
//                    return $point_b;
//                }
//                $point_b = $point_b->next;
//            }
//            $headA = $headA->next;
//        }
//
//        return $headA;
        #endregion

        #region 双指针
        $point_a = $headA;
        $point_b = $headB;
        while ($point_a !== $point_b) {
            $point_a = $point_a == null ? $headB : $point_a->next;
            $point_b = $point_b == null ? $headA : $point_b->next;
        }
        return $point_a;
        #endregion
    }

    //编写一个程序，找到两个单链表相交的起始节点。
    function test()
    {
        $hearA = self::convertArrayToLinkedList([4, 2]);
        $hearB = self::convertArrayToLinkedList([5, 0, 1]);
        $head_tail = self::convertArrayToLinkedList([8, 4, 5]);

        $hearA = self::connectTwoList($hearA, $head_tail);
        $hearB = self::connectTwoList($hearB, $head_tail);

        print_r($this->GetIntersectionNode($hearA, $hearB));
    }
}

(new Solution())->test();


