<?php


namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

use \algorithm\linked_list\base\ListNode as ListNode;

class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
	#region 奇偶链表
	 function oddEvenList($head) {
		 //奇数
		 $odd_head  = $head;
		 $odd = $odd_head;;
		 //偶数
		 $even_head = $odd_head->next;;
		 $even = $even_head;
		 while($even != null && $even->next != null){
			 $odd->next  = $even->next;
			 $odd = $odd->next;
			 $even->next = $odd->next;
			 $even = $even->next;
		 }
		 
		 $odd->next = $even_head;
		 return $head;
	 }
	#endregion
	
	#region 遍历移动
    function oddEvenList1($head) {
		$temp = $head;
		$length = 0;
		while(!is_null($temp)){
			$length++;
			$temp = $temp->next;
		}
		
		$step = 1;
		$max = ($length -1) / 2;
		$temp = $head;
		
		for($i = 1;$i <= $max;$i++){
			$back = $temp;
			$j = $i;
			while($j-- > 0){
				$back = $back->next;
			}
			$foward = $back->next;
			
			$back->next = $foward->next;
			$foward->next = $temp->next;
			$temp->next = $foward;
			
			$temp = $temp->next;
		}
		return $head;
    }
	#endregion
	
	function test(){
		//1 2 3 4 5
		//1 3 2 4 5
				$head =self::convertArrayToLinkedList([1,2,3]);
		print_r($this->oddEvenList($head));
		$head =self::convertArrayToLinkedList([1,2,3,4]);
		print_r($this->oddEvenList($head));
				$head =self::convertArrayToLinkedList([1,2,3,4,5]);
		print_r($this->oddEvenList($head));
				$head =self::convertArrayToLinkedList([1,2,3,4,5,6,7]);
		print_r($this->oddEvenList($head));
	}
}

(new Solution())->test();