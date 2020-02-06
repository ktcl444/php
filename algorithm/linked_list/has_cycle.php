<?php


namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

use \algorithm\linked_list\base\ListNode as ListNode;

class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
    public function HasCycle($head)
    {
        if ($head == null || $head->next == null) return false;
        #region hash
//        $node_set = [];
//        while ($head->next != null) {
//            if (in_array($head, $node_set)) {
//                return true;
//            }
//            array_push($node_set, $head);
//            $head = $head->next;
//        }
//
//        return false;
        #endregion

        #region 双指针
        $slow = $head;
        $fast = $head->next;
        while ($slow != $fast) {
            if ($fast == null || $fast->next == null) {
                return false;
            }
            $slow = $slow->next;
            $fast = $fast->next->next;
        }
        return true;
        #endregion
    }

    function test()
    {
        echo $this->HasCycle(self::convertArrayToLinkedList([3, 2, 0, -4], 1)) . PHP_EOL;
        echo $this->HasCycle(self::convertArrayToLinkedList([1, 2], 0)) . PHP_EOL;
        echo $this->HasCycle(self::convertArrayToLinkedList([1], -1)) . PHP_EOL;
        echo $this->HasCycle(self::convertArrayToLinkedList([])) . PHP_EOL;
    }
}

(new Solution())->test();