<?php
namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';
class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase {

	private $carry = 0;

    function addTwoNumbers($l1, $l2) {
		$length1 =$this->getNodeLenth($l1);
		$length2 = $this->getNodeLenth($l2);
		$result = $length1 > $length2 ? $this->add($l1,$l2,$length1,$length2):$this->add($l2,$l1,$length2,$length1);
		if($this->carry ==1){
			$root =new \algorithm\linked_list\base\ListNode(1);
			$root->next = $result;
			return $root;
		}
		
		return $result;
	}
	
	function add($l1,$l2,$length1,$length2)
	{
		if($length1 ==1 && $length2 == 1){
			$temp = $l1->val + $l2->val;
			$l1->val = $temp % 10;
			$this->carry = intval($temp /10);
			return $l1;
		}
		if($length1 > $length2){
			$l1->next = $this->add($l1->next,$l2,$length1 - 1,$length2);
			$temp = $l1->val + $this->carry;
			$l1->val = $temp % 10;
			$this->carry = intval($temp /10);
			return $l1;
		}
		$l1->next = $this->add($l1->next,$l2->next,$length1-1,$length2 -1);
		$temp = $l1->val + $l2->val +$this->carry;
				$l1->val = $temp % 10;
			$this->carry = intval($temp /10);
			return $l1;
	}

	function getNodeLenth($node)
	{
		$length = 0;
		while(isset($node)){
			$length ++;
			$node = $node->next;
		}
		return $length;
	}

    function test()
    {
        $l1 = self::convertArrayToLinkedList([7,2,4,3]);
        $r1 = self::convertArrayToLinkedList([5,4,3]);
        print_r(self::addTwoNumbers($l1,$r1));
    }
}

(new Solution())->test();
