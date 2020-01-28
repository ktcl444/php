<?php
namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';
class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {
		$s1 = []	;
		$s2 = [];
		while(isset($l1)){
			array_push($s1,$l1->val);
			$l1=$l1->next;
		}		while(isset($l2)){
			array_push($s2,$l2->val);
			$l2=$l2->next;
		}
		
		$carry = 0;
		$head = new ListNode(-1);
		while(!empty($s1) || !empty($s2) || $carry >0)
		{
			$n1 = isset($s1)?array_pop($s1):0;
			$n2 = isset($s2)?array_pop($s2):0;
			$sum = $n1 + $n2 +$carry;
			
			$node  =new ListNode($sum%10);
			$carry = intval($sum / 10);
			
			
			$node->next = $head->next;
			$head->next = $node;
			}
		
		
		return $head->next;
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