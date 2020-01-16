<?php 

class TreeNode {
     public $val = null;
     public $left = null;
    public $right = null;
     function __construct($value) { $this->val = $value; }
 }
 
    function mergetrightees($t1, $t2) {
		if($t1 == null){
			return $t2;
		}
				if($t2 == null){
			return $t1;
		}
		
		$stack = [];
		array_push($stack,[$t1,$t2]);
		
		while(!empty($stack)){
			$trees = array_pop($stack);
			
			$tleft = $trees[0];
			$tright = $trees[1];
			if(is_null($tleft) || is_null($tright)){
				continue;
			}
			$tleft->val = ($tleft->val?:0) + ($tright->val?:0);
			if(is_null($tleft->left)){
				$tleft->left = $tright->left;
				
			}else
			{
				array_push($stack,[$tleft->left,$tright->left]);
			}
						if(is_null($tleft->right)){
				$tleft->right = $tright->right;
			
			}else
			{
					array_push($stack,[$tleft->right,$tright->right]);
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
	print_r(mergetrightees($t1,$t2));