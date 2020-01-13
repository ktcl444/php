<?php
 class ListNode {
     public $val = 0;
    public $next = null;
     function __construct($val) { $this->val = $val; }
 }
/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution {

	private $carry = 0;

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {
		$length1 =$this->getNodeLenth($l1);
		$length2 = $this->getNodeLenth($l2);
					echo $length1 .PHP_EOL;
					echo $length2 .PHP_EOL;
		$result = $length1 > $length2 ? $this->add($l1,$l2,$length1,$length2):$this->add($l2,$l1,$length2,$length1);
		if($this->$carry ==1){
			$root =new ListNode(1);
			$root->next = $result;
			return $root;
		}
		
		return $result;
	}
	
	function add($l1,$l2,$length1,$length2)
	{
		if($length1 <= 0 || $length2 <= 0)
		{
						echo $length1 .PHP_EOL;
					echo $length2 .PHP_EOL;
					exit;
		}
		$temp = 0; 
		if($length1 ==1 && $length2 == 1){
			
			echo '=';
			$temp = $l1->val + $l2->val;
			$l1->val = $temp % 10;
			$this->$carry = intval($temp /10);
			return $l1;
		}
		if($length1 > $length2){
			echo '>';
			$l1->next = $this->add($l1->next,$l2,$length1 - 1,$length2);
			$temp = $l1->val + $this->$carry;
			$l1->val = $temp % 10;
			$this->$carry = intval($temp /10);
			return $l1;
		}
			echo '!=';
		$l1->next = $this->add($l1->next,$l2->next,$length1-1,$length2 -1);
		$temp = $l1->val + $l2->val +$this->$carry;
				$l1->val = $temp % 10;
			$this->$carry = intval($temp /10);
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
}

$l1 = new ListNode(7);
$l2 = new ListNode(2);
$l3 = new ListNode(4);
$l4 = new ListNode(3);

$l3->next = $l4;
$l2->next = $l3;
$l1->next = $l2;

$r1 = new ListNode(5);
$r2 = new ListNode(4);
$r3 = new ListNode(3);

$r2->next = $r3;
$r1->next = $r2;

print_r((new Solution())->addTwoNumbers($l1,$r1));