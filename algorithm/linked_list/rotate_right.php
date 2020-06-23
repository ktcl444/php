<?php


namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

use \algorithm\linked_list\base\ListNode as ListNode;
//旋转链表-断开新联
class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
	function rotateRight($head, $k) {
         if(is_null($head)|| $k == 0)
            return $head;
        $length = 1;
        $tail = $head;
        while($tail->next != null){
            $tail = $tail->next;
            $length++;
        }
        if($lengt==1)return $head;
        $k = $length - $k % $length;
        $cur = $head;
        while($k > 1){
            $cur = $cur->next;
            $k--;
        }
        $tail->next = $head;
        $head = $cur->next;
        $cur->next = null;
        
        return $head;
      
    }
	function test(){

	}
}

(new Solution())->test();