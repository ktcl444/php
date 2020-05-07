<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;
//二叉搜索树中第k小的数
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	#region 迭代
    function kthSmallest($root, $k) {
		$stack= [];
		while(true){
			while($root != null){
				$stack[] = $root;
				$root = $root->left;
			}
			$root = array_pop($stack);
			if(--$k == 0)return $root->val;
			$root = $root->right;
		}
	}
	#endregion
	
	#region 递归
    function kthSmallest2($root, $k) {
		$array = $this->helper($root);
		return $array[$k-1];
    }
	
	function helper($node){
		if(is_null($node))return [];
		$array = $this->helper($node->left);
		$array[] = $node->val;
		return array_merge($array,$this->helper($node->right));
	}	
	#endregion
	
	function test(){
		$root = self::convertArrayToTree([3,1,4,null,2]);
		echo $this->kthSmallest($root,1).PHP_EOL;
	}
}

(new Solution())->test();