<?php


namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

use \algorithm\linked_list\base\ListNode as ListNode;

class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
	#region 分治(两两合并)
	function mergeKLists($lists)
	{
		$amount = count($lists);
		$interval = 1;
		while($interval < $amount)
		{
			for($i = 0;$i< $amount - $interval;$i += $interval * 2)
			{
				$lists[$i] = $this->mergeTwoLists($lists[$i],$lists[$i+$interval]);
			}
			$interval = $interval * 2;
		}
		
		return $amount > 0 ? $lists[0] : $lists;
	}
	function mergeTwoLists($l1,$l2)
	{
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

        $temp->next = is_null($l1) ? $l2 : $l1;

        return $head->next;
	}
	#endregion
	#region 暴力(合并排序)
	function mergeKLists2($lists)
	{
		$stack = [];
		for($i = 0;$i<count($lists);$i++)
		{
			$linked_list = $lists[$i];
			while($linked_list != null)
			{
				$stack[] = $linked_list->val;
				$linked_list = $linked_list->next;
			}
		}
		
		sort($stack);
        $result = new ListNode(0);
        $result->next = new ListNode($stack[0]);
        $temp = $result->next;
        for($i = 1;$i<count($stack);$i++)
        {
            $temp->next = new ListNode($stack[$i]);
            $temp = $temp->next;
        }
		return $result->next;;
	}
	#endregion
	function test(){
		print_r($this->mergeKLists(
			[
				self::convertArrayToLinkedList([1,4,5]),
				self::convertArrayToLinkedList([1,3,4]),
				self::convertArrayToLinkedList([2,6])
			]
		));
	}
}

(new Solution())->test();