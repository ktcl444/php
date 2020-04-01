<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

//验证二叉搜索树-迭代
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	#region 中序遍历(每一个元素都要应该比上一个大)
	function isValidBST($root) {
		$order = PHP_INT_MIN;
		$stack = [];
		
		while(!empty($stack) || $root != null)
		{
			while($root != null)
			{
				$stack[] = $root;
				$root = $root->left;
			}
			
			$root = array_pop($stack);
			if($root->val<=$order)return false;
			$order = $root->val;
			
			$root = $root->right;
		}
		
		return true;
	}
	#endregion
	
	#region 递归
	function isValidBST1($root) {
		return $this->helper($root,null,null);
	}
	
	function helper($node,$low,$high)
	{
		if(is_null($node))return true;
		$val = $node->val;
		if(!is_null($low) && $val <= $low) return false;
		if(!is_null($high) && $val>=$high) return false;
		
		if(!$this->helper($node->left,$low,$val)) return false;
		if(!$this->helper($node->right,$val,$high)) return false;
		
		return true;
	}
	
	#endregion
	
	#region 迭代
	private $nodes = [];
	private $lows = [];
	private $highs = [];
	
	function isValidBST3($root) {
		$this->update_stack($root,null,null);
		
		while(!empty($this->nodes))
		{
			$node = array_pop($this->nodes);
			$low = array_pop($this->lows);
			$high = array_pop($this->highs);
			
			if(is_null($node))continue;
			$val = $node->val;
			if(!is_null($low) && $val <= $low) return false;
			if(!is_null($high) && $val>=$high) return false;
		
			$this->update_stack($node->left,$low,$val);
			$this->update_stack($node->right,$val,$high);
		}
		
		return true;
	}
	
	function update_stack($node,$low,$high){
		array_push($this->nodes,$node);
		array_push($this->lows,$low);
		array_push($this->highs,$high);
	}
	#endregion
	
	#region 动态规划(记录每个节点的上下限)
    function isValidBST2($root) {
		if(empty($root))return true;
		$dp = [];
		$nodes = [$root];
		while(!empty($nodes))
		{
			$node = array_pop($nodes);
			$val = $node->val;
			if(array_key_exists($val,$dp))return false;
			$left = $node->left;
			$right = $node->right;
			$left_val = is_null($left)? PHP_INT_MIN : $left->val;
			$right_val = is_null($right)?PHP_INT_MAX : $right->val;
			if($left_val < $val && $val < $right_val)
			{
				$dp[$val] = [$left_val,$right_val]; 
				!is_null($right) && array_push($nodes,$right);
				!is_null($left) && array_push($nodes,$left);
			}else
			{
				return false;
			}
		}
		//print_r($dp);
		foreach($dp as $val => $range)
		{
			$min = $range[0];
			$max = $range[1];
			while(array_key_exists($min,$dp)){
				$min = $dp[$min][1];
				if($min !=PHP_INT_MAX && $min > $val)
				{
					return false;
				}
			}
			while(array_key_exists($max,$dp)){
				$max = $dp[$max][0];
				if($max != PHP_INT_MIN && $max < $val)
				{
					return false;
				}
			}
		}
		return true;
    }
	#endregion
	
	function test(){
		echo $this->isValidBST(self::convertArrayToTree([3,1,5,0,2,4,6,null,null,null,3])) ? '1' :'0';
		echo $this->isValidBST(self::convertArrayToTree([2,1,3])) ? '1' :'0';
		echo $this->isValidBST(self::convertArrayToTree([10,5,15,null,null,6,20])) ? 1:0;
	}
}

(new Solution())->test();