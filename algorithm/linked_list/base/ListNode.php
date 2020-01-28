<?php

namespace algorithm\linked_list\base;
class ListNode
{
    public $val = 0;
    public $next = null;
    function __construct($val) { $this->val = $val; }
}