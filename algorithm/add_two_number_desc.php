<?php
 class ListNode {
     public $val = 0;
    public $next = null;
     function __construct($val) { $this->val = $val; }
 }


    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {
		$result = new ListNode(0);
		$l = $l1;
		$r = $l2;
		$curr = $result;
		$carry = 0;
		
		while(isset($l) || isset($r)){
			$x =isset($l) ?$l->val:0;
			$y = isset($r)?$r->val:0;
			$sum = intval($x+$y+$carry);
			$carry = intval($sum/10);
			$curr->next = new ListNode(intval($sum % 10));
			$curr = $curr->next;
			if(isset($l))
				$l = $l->next;
			if(isset($r))
				$r = $r->next;
		}
		
		if($carry >0 ){
			$curr->next = new ListNode($carry);
		}
		
        return $result->next;
    }

	