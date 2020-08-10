<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;
//对称的二叉树-dfs
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    function isSymmetric($root) {		
		return $this->compare($root->left,$root->right);
    }
	
	function compare($left,$right){
		if(empty($left) && empty($right))
			return true;
		if(!empty($left) && !empty($right)){
			if($left->val != $right->val)
				return false;
			return $this->compare($left->left,$right->right) && $this->compare($left->right,$right->left);
		}else{
			return false;
		}
	}
	
    function test()
    {
		$root = self::convertArrayToTree([5,4,1,null,1,null,4,2,null,2,null]);
		echo ($this->isSymmetric($root) ? '1':'0').PHP_EOL;
    }
}

(new Solution())->test();