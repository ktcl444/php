<?php

namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

use \algorithm\linked_list\base\ListNode as ListNode;

class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
    function sortList($head)
    {
        if ($head == null || $head->next == null) return $head;
        $slow = $head;
        $fast = $head->next;
        while ($fast != null && $fast->next != null) {
            $slow = $slow->next;
            $fast = $fast->next->next;
        }
        $center = $slow->next;
        $slow->next = null;
        $left = $this->sortList($head);
        $right = $this->sortList($center);
        $root = new ListNode(0);
        $temp = $root;
        while ($left != null && $right != null) {
            if ($left->val < $right->val) {
                $root->next = $left;
                $left = $left->next;
            } else {
                $root->next = $right;
                $right = $right->next;
            }
            $root = $root->next;
        }
        $root->next = $left != null ? $left : $right;
        return $temp->next;
    }

    function test()
    {
        print_r($this->sortList(self::convertArrayToLinkedList([4, 2, 1, 3])));
    }
}

(new Solution())->test();