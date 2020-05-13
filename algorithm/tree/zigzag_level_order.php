<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';
//二叉树的锯齿遍历-DFS+BFS
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	//BFS
    function zigzagLevelOrder2($root) {
        if(is_null($root))return [];
        $level = 0;
		$stack = [$root];
		$result = [];
		while(!empty($stack)){
			$child_list = [];
			$level_list = [];
			while(!empty($stack)){
				$odd = $level % 2 == 0;
				if($odd){
					$node = array_shift($stack);
					!is_null($node->left) && $child_list[] = $node->left;
					!is_null($node->right) && $child_list[] = $node->right;
				}else{
					$node = array_pop($stack);
					!is_null($node->right) && array_unshift($child_list,$node->right);
					!is_null($node->left) && array_unshift($child_list,$node->left);
				}
				$level_list[] = $node->val;
			}
			$level++;
			$result[] = $level_list;
			$stack = $child_list;
		}
		
		return $result;
    }
	
	//DFS
	function zigzagLevelOrder($root){
		if(is_null($root))return [];
		$result = [];
		$level = 0;
		$this->helper($root,$level,$result);
		return $result;
	}
	
	function helper($node,$level,&$result){
		if($level >= count($result)){
			$level_list = [$node->val];
			$result[$level] = $level_list;
		}else{
			$level_list = $result[$level];
			if($level % 2 == 0){
				array_push($level_list,$node->val);
			}else{
				array_unshift($level_list,$node->val);
			}
			$result[$level] = $level_list;
		}
		
		!is_null($node->left) && $this->helper($node->left,$level + 1,$result);
		!is_null($node->right) && $this->helper($node->right,$level + 1,$result);
	}

	
	function test(){
		$root = self::convertArrayToTree([3,9,20,null,null,15,7]);
		print_r( $this->zigzagLevelOrder($root));
				$root = self::convertArrayToTree(	[1,2,3,4,null,null,5]);
		print_r( $this->zigzagLevelOrder($root));
	
	}
}

(new Solution())->test();