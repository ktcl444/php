<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;
//有序数组转换为高度平衡二叉树-递归
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	function sortedArrayToBST($nums) {
        return $this->helper($nums);
    }
	
	function helper($nums){
		$length = count($nums);
		if($length == 1)return new TreeNode($nums[0]);
		
		$center = $length/2 ;
		$left = array_slice($nums,0,$center);
		$right = array_slice($nums,$center + 1);
		
		$root = new TreeNode($nums[$center]);
		
		!empty($left) && $root->left = $this->helper($left);
		!empty($right) && $root->right = $this->helper($right);
		
		return $root;
	}
	
	function test(){
		print_r($this->sortedArrayToBST([-10,-3,0,5,9]));
	}
}

(new Solution())->test();