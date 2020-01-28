<?php
namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';
class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
    function addTwoNumbers($l1, $l2)
    {
        $result = new \algorithm\linked_list\base\ListNode(0);
        $l = $l1;
        $r = $l2;
        $curr = $result;
        $carry = 0;

        while (isset($l) || isset($r)) {
            $x = isset($l) ? $l->val : 0;
            $y = isset($r) ? $r->val : 0;
            $sum = intval($x + $y + $carry);
            $carry = intval($sum / 10);
            $curr->next = new \algorithm\linked_list\base\ListNode(intval($sum % 10));
            $curr = $curr->next;
            if (isset($l))
                $l = $l->next;
            if (isset($r))
                $r = $r->next;
        }

        if ($carry > 0) {
            $curr->next = new \algorithm\linked_list\base\ListNode($carry);
        }

        return $result->next;
    }

    function test()
    {
        $l1 = self::convertArrayToLinkedList([3,4,2]);
        $l2 = self::convertArrayToLinkedList([4,5,9]);
        print_r($this->addTwoNumbers($l1,$l2));
    }
}

(new Solution())->test();
	