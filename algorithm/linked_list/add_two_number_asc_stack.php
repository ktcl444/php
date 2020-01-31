<?php

namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{

    function addTwoNumbers($l1, $l2)
    {
        $s1 = [];
        $s2 = [];
        while (isset($l1)) {
            array_push($s1, $l1->val);
            $l1 = $l1->next;
        }
        while (isset($l2)) {
            array_push($s2, $l2->val);
            $l2 = $l2->next;
        }

        $carry = 0;
        $head = new \algorithm\linked_list\base\ListNode(-1);
        while (!empty($s1) || !empty($s2) || $carry > 0) {
            $n1 = isset($s1) ? array_pop($s1) : 0;
            $n2 = isset($s2) ? array_pop($s2) : 0;
            $sum = $n1 + $n2 + $carry;

            $node = new \algorithm\linked_list\base\ListNode($sum % 10);
            $carry = intval($sum / 10);


            $node->next = $head->next;
            $head->next = $node;
        }


        return $head->next;
    }

    function test()
    {
        $l1 = self::convertArrayToLinkedList([7, 2, 4, 3]);
        $l2 = self::convertArrayToLinkedList([5, 4, 3]);
        print_r($this->addTwoNumbers($l1, $l2));
    }
}

(new Solution())->test();