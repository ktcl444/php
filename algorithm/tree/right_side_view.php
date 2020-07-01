<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	//dfs(递归)
	function rightSideView($root) {
        $res = [];
        $level = 0;
        $this->helper($root, $res, $level);
        return $res;
    }
    
    function helper($node, &$res, $level)
    {
        if ($node == null) {
            return;
        }
        $res[$level] = $node->val;
        $this->helper($node->left, $res, $level + 1);
        $this->helper($node->right, $res, $level + 1);
    }
	//bfs 
	function rightSideView1($root){
		$temp = [[$root,1]];
		$dept_mapping = [];
		$max_dept = 0;
		while(!empty($temp)){
            $node_s = array_shift($temp);
            $node = $node_s[0];
            $level = $node_s[1];
			if(!empty($node->left)){
				$temp[] = [$node->left,$level + 1];
			}
			if(!empty($node->right)){
				$temp[] = [$node->right,$level + 1];
			}
			$dept_mapping[$level] = $node->val;
			$max_dept=max($max_dept,$level);
        }
		
		return $dept_mapping;
	}
	
	 //dfs
    function rightSideView2($root) {
        $temp = [[$root,1]];
        $res = [];
        $cur_level = 0;
        while(!empty($temp)){
            $node_s = array_pop($temp);
            $node = $node_s[0];
            $level = $node_s[1];
			if(!empty($node->left)){
				$temp[] = [$node->left,$level + 1];
			}
			if(!empty($node->right)){
				$temp[] = [$node->right,$level + 1];
			}
            if($level > $cur_level){
                $res[] = $node->val;
                $cur_level = $level;
            }
        }
		
        return $res;
    }
	
    function test()
    {
		print_r($this->rightSideView($this->convertArrayToTree([4,3,6,1,null,5,null,null,2])));
    }
}

(new Solution())->test();