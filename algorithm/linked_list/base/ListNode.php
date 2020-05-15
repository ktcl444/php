<?php

namespace algorithm\linked_list\base;
class ListNode
{
    public $val = null;
    public $next = null;
	 public $random = null;
    function __construct($val = 0) { 
		$this->val = $val; 
		$this->next = null;
		$this->random = null;
	}
}