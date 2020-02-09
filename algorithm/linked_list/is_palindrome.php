<?php


namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

use \algorithm\linked_list\base\ListNode as ListNode;

class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
    function isPalindrome($head)
    {
        if (is_null($head) || is_null($head->next))
            return true;

        #region 反转
        $first_half_end = $this->getFirstHalfEnd($head);
        $second_array = $this->reverseList($first_half_end->next);
        $first_array = $head;

        while ($second_array != null) {
            if ($first_array->val != $second_array->val) return false;
            $first_array = $first_array->next;
            $second_array = $second_array->next;
        }

        return true;
        #endregion

        #region 数组遍历
//        $array = [];
//        while ($head != null) {
//            array_push($array, $head->val);
//            $head = $head->next;
//        }
//        while (!empty($array) && count($array) > 1) {
//            $first = array_shift($array);
//            $end = array_pop($array);
//            if ($first != $end) {
//                return false;
//            }
//        }
//
//        return true;
        #endregion
    }

    private function getFirstHalfEnd($head)
    {
        $slow = $head;
        $fast = $head->next;

        while ($fast != null && $fast->next != null) {
            $slow = $slow->next;
            $fast = $fast->next->next;
        }

        return $slow;
    }

    private function reverseList($head)
    {
        $pre = null;
        $cur = $head;
        while ($cur != null) {
            $temp = $cur->next;
            $cur->next = $pre;
            $pre = $cur;
            $cur = $temp;
        }

        return $pre;
    }

    function test()
    {
        echo $this->isPalindrome(self::convertArrayToLinkedList([1, 2])) . PHP_EOL;
        echo $this->isPalindrome(self::convertArrayToLinkedList([1, 0, 1])) . PHP_EOL;
        echo $this->isPalindrome(self::convertArrayToLinkedList([1, 2, 2, 1])) . PHP_EOL;
        echo $this->isPalindrome(self::convertArrayToLinkedList([1, 2, 2, 2, 2, 1])) . PHP_EOL;
    }
}

(new Solution())->test();