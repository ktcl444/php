<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;
//二叉树的最大路径和-递归
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	private $max_path = PHP_INT_MIN;
	function maxPathSum($root)
	{
		$this->getMaxPath($root);
		return $this->max_path;
	}
	
	//对于每个根节点 有2种选择
	//1,不往上走 本层完成路径
	//2,仍往上走 从左右点选择一个最大的继续
	function getMaxPath($node)
	{
		if(is_null($node))return 0;
		
		$left = max($this->getMaxPath($node->left),0);
		$right = max($this->getMaxPath($node->right),0);
		
		$val = $node->val;
		//如果不往上级节点走了
		$new_path = $val + $left + $right;
		
		$this->max_path = max($this->max_path,$new_path);
		//如果继续往上级节点走
		return $val + max($left,$right);
	}
	
	function test(){
		echo $this->getMaxPath(self::convertArrayToTree([-10,9,20,null,null,15,7])).PHP_EOL;
	}
}

(new Solution())->test();