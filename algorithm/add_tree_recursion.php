<?php 

class TreeNode {
     public $val = null;
     public $left = null;
    public $right = null;
     function __construct($value) { $this->val = $value; }
 }
 
    function mergeTrees($t1, $t2) {
		if($t1 == null && $t2 == null){
			return null;
		}
		
		$val = ($t1->val?:0)+($t2->val?:0);
		$node = new TreeNode($val);
		$node->left = mergeTrees($t1->left?:null,$t2->left?:null);
		$node->right = mergeTrees($t1->right?:null,$t2->right?:null);
		
       return $node;
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
	print_r(mergeTrees($t1,$t2));