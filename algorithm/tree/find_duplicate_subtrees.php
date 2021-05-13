<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';
//寻找重复的子树-DFS
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{   	
	    private $map;
    private $ans;
    function findDuplicateSubtrees($root) {
        $this->map = [];
        $this->ans = [];
        $this->dfs($root);
        return $this->ans;
    }

    function dfs($node){
        if($node == null)
            return 'null';
        $left = $this->dfs($node->left);
        $right = $this->dfs($node->right);
		$cur = $node->val.'.'.$left.'.'.$right;

        if(array_key_exists($cur,$this->map)){
            $this->map[$cur]++;
        }else{
            $this->map[$cur] = 1;
        }
        if($this->map[$cur] == 2){
			//echo($cur).PHP_EOL;
            $this->ans[] = $node;
        }

        return $cur;
    }
	
	function test(){
		$root = self::convertArrayToTree([0,0,0,0,null,null,0,null,null,null,0]);
		print_r( $this->findDuplicateSubtrees($root));
	
	}
}

(new Solution())->test();