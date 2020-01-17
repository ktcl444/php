<?php

class TreeNode {
     public $val = null;
     public $left = null;
    public $right = null;
     function __construct($value) { $this->val = $value; }
}
	 
    function maxDepth($root) {
        if(is_null($root))
        {
            return 0;
        }
        $deep = 1;
       // $stack= [[$root->left,$root->right,$deep+1]];
		$stack = [[$root,$deep]];
        while(!empty($stack)){
            $node = array_shift($stack);
			if(is_null($node[0]))continue;
			$deep = max($deep,$node[1]);
			if(!is_null($node[0]->left))
			array_push($stack,[$node[0]->left,$deep+1]);
            if(!is_null($node[0]->right))
			array_push($stack,[$node[0]->right,$deep+1]);
/*             if(is_null($node[0]) && is_null($node[1])){
                continue;
            }
            if(!is_null($node[0]) || !is_null($node[1])){
                $deep =  max($deep,$node[2]);
            }
            if(!is_null($node[0])){
             array_push($stack,[$node[0]->left,$node[0]->right,$deep+1]);
            }
                 if(!is_null($node[1])){
             array_push($stack,[$node[1]->left,$node[1]->right,$deep+1]);
            }
			
			print_r($stack);
			echo PHP_EOL.$deep; */
        }
        return $deep;
	}
	
	$root = new TreeNode(0);
	$root_1 = new TreeNode(2);
		$root_2 = new TreeNode(4);
		
			$root_3_1 = new TreeNode(1);
				$root_3_2= new TreeNode(-3);
					$root_3_3 = new TreeNode(3);
						$root_3_4 = new TreeNode(-1);
						
						
							$root_4_1 = new TreeNode(5);
								$root_4_2 = new TreeNode(1);
									$root_4_3 = new TreeNode(6);
										$root_4_4 = new TreeNode(8);
	
 	$root_3_1->left = $root_4_1;
		$root_3_1->right = $root_4_2;
	$root_3_3->right = $root_4_3;
		$root_3_4->right = $root_4_4; 
		
		$root_1->left = $root_3_1;
		$root_1->right = $root_3_2;
		$root_2->left = $root_3_3;
		$root_2->right = $root_3_4;
		
		$root->left = $root_1;
		$root->right = $root_2;
		
		echo maxDepth($root);