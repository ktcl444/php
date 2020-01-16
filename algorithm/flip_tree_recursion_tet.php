<?php 

class TreeNode {
     public $val = null;
     public $left = null;
    public $right = null;
     function __construct($value) { $this->val = $value; }
 }
 
    function invertTree($t1) {
		if($t1 == null){
			return $t1;
		}
		$stack = [$t1];
		while(!empty($stack)){
			$node = array_pop($stack);
			$temp = $node->left;
			$node->left = $node->right;
			$node->right = $temp;
			if(!is_null(			$node->left))
			{
				array_push($stack,$node->left);
			}
			if(!is_null($node->right))
			{
				array_push($stack,$node->right);
			}
		}
		
		return $t1;
    }
	
	$t1 = new TreeNode(1);
	$t1_l = new TreeNode(2);
 	$t1_r = new TreeNode(3);
	$t1->left = $t1_l;
	$t1->right = $t1_r;
	
		$t2 = new TreeNode(3);
	$t2_l = new TreeNode(2);
 	$t2_r = new TreeNode(1);
	$t2->left = $t2_l;
	$t2->right = $t2_r;
	print_r(invertTree($t1));
		print_r(invertTree($t2));