<?php


namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

use \algorithm\linked_list\base\ListNode as ListNode;
//链表的中间节点-双指针
class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
	function middleNode($head) {
        $l = $head;
        $r =  $head;
        while($r->next != null){
            $l = $l->next;
            $r = $r->next->next;
        }

        return $l;
    }
	
	function test(){

	}
}

(new Solution())->test();