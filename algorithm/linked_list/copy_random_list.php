<?php


namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

use \algorithm\linked_list\base\ListNode as ListNode;
//复制带随机指针的链表-新旧交错
class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
    function copyRandomList($head) {
       $copy = $head;
	   while(!is_null($copy)){
		   $clone = new ListNode($copy->val);
		   $clone->next = $copy->next;
		   $copy->next = $clone;
		   $copy = $clone->next;
	   }
	   $copy = $head;
	   while(!is_null($copy)){
		   $copy->next->random = is_null($copy->next) ? null:$copy->random->next;
		   $copy = $copy->next->next;
	   }
	   
	   $copy_old_list = $head;
	   $copy_new_list = $head->next;
	   $copy_new_head = $head->next;
	   while(!is_null($copy_old_list)){
		   $copy_old_list->next = $copy_old_list->next->next;
		   if(!is_null($copy_new_list->next)){
			   $copy_new_list->next = $copy_new_list->next->next;
		   }
		   $copy_old_list = $copy_old_list->next;
		   $copy_new_list = $copy_new_list->next;
	   }
	   
	   return $copy_new_head;
    }
	
	function test(){

	}
}

(new Solution())->test();