<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;
//二叉树的右视图-BFS+DFS
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	#region 递归
	function hasPathSum($root, $sum) {
		if(empty($root))return false;
		$sum -= $root->val;
		if(empty($root->left) && empty($root->right)){
			 return $sum == 0;
		}
		
		return $this->hasPathSum($root->left,$sum) || $this->hasPathSum($root->right,$sum);
	}
	#endregion
	#region DFS
	function hasPathSum1($root, $sum) {
        if(empty($root))return false;
        $path = [[$root,$root->val]];
        while(!empty($path)){
            $temp = array_pop($path);
            $node = $temp[0];
            $value = $temp[1];
            if(empty($node->left) && empty($node->right)){
                if($value == $sum)
                    return true;
            }else{
                if(!empty($node->left)){
                    $path[] = [$node->left,$value + $node->left->val];
                }
                if(!empty($node->right)){
                    $path[] = [$node->right,$value + $node->right->val];
                }
            }
        }

        return false;
    }
	#endregion
	
	
    function test()
    {
		$root = self::convertArrayToTree([5,4,8,11,null,13,4,7,2,null,null,null,1]);
		echo ($this->hasPathSum($root,22) ? '1':'0').PHP_EOL;
    }
}

(new Solution())->test();