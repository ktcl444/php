<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	function countSmaller($nums) {
		if(empty($nums))return [];
		$length = count($nums);
		$res = array_fill(0,$length,0);
		$root = null;
		for($i = $length - 1;$i >= 0;$i--){
			$root = $this->insert($root,new TreeNode($nums[$i]),$res,$i);
		print_r($root);
		}
		
		return $res;
	}
	
	function insert($root,$node,&$res,$i){
		if(is_null($root)){
			$root = $node;
			return $root;
		}
		
		if($root->val >= $node->val){
			$root->count++;
			$root->left = $this->insert($root->left,$node,$res,$i);
		}else{
			$res[$i] += $root->count + 1;
			$root->right = $this->insert($root->right,$node,$res,$i);
		}
		return $root;
	}

    function test()
    {
		print_r($this->countSmaller([5,2,6,1]));
    }
}

(new Solution())->test();