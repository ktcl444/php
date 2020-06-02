<?php
namespace algorithm\tree\base;

class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;
	public $count = 0;

    function __construct($value)
    {
        $this->val = $value;
    }
}