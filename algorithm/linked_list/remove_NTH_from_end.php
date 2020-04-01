<?php


namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

use \algorithm\linked_list\base\ListNode as ListNode;

//删除链表的倒数第n个节点
class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
	#region 双指针
	 function removeNthFromEnd($head, $n) {
		 $temp  = new ListNode(0);
		 $temp->next = $head;
		 $first = $temp;
		 $second = $temp;
		 for($i=0;$i<=$n;$i++)
		 {
			 $first =$first->next;
		 }
		 while($first != null)
		 {
			 $first = $first->next;
			 $second = $second->next;
		 }
		 $second->next = $second->next->next;
		 return $temp->next;
	 }
	 #endregion
	#region  堆栈暂存(每一个位置的前后节点)
    function removeNthFromEnd2($head, $n) {
		$mapping = [];
		$temp_head = null;
		$temp_end = null;
		$index = 0;
		while($head != null)
		{
			$val = $head->val;
			$temp_end = $head->next;
			$copy =is_null($temp_head) ? null : $this->copy($temp_head);
			$mapping[$index++] = [$copy,$temp_end];
			
			if($temp_head == null)
			{
				$temp_head = new ListNode($val);
			}else
			{
				$this->push($temp_head,new ListNode($val));
			}				
			$head = $head->next;
		}
		//print_r($mapping);
        return $this->meger($mapping,$index - $n);
    }
	function meger($mapping,$index)
	{
		$map = $mapping[$index];
		$head = $map[0];
		$end = $map[1];
		if(is_null($head))
		{
			return $end;
		}else{
			$this->push($head,$end);
			return $head;
		}
	}
	function push($head,$end)
	{
		$temp_head = $head;
		while($temp_head->next != null)
		{
			$temp_head = $temp_head->next;
		}
		$temp_head->next = $end;
	}
	function copy($o)
	{
		return unserialize(serialize($o));
	}
	#endregion
	function test(){
		print_r($this->removeNthFromEnd(self::convertArrayToLinkedList([1,2]),2));
		print_r($this->removeNthFromEnd(self::convertArrayToLinkedList([1,2,3,4,5]),2));
	}
}

(new Solution())->test();