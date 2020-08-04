<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;
//叶子相似的树-DFS
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    function leafSimilar($root1, $root2) {
        $res1 = $this->dfs($root1);
        $res2 = $this->dfs($root2);
		//print_r($res1);
		//print_r($res2);
        return $res1 == $res2;
    }

    function dfs($root){
        if(empty($root))return [];
        $list = [$root];
        $ans = [];
        while(!empty($list)){
            $node = array_pop($list);
			//print_r($node);
            if(empty($node->left) && empty($node->right)){
                $ans[] = $node->val;
            }else{
                if(!empty($node->right)){
                    $list[] = $node->right;
                }
                if(!empty($node->left)){
                    $list[] = $node->left;
                }
            }
        }

        return $ans;
    }
	
    function test()
    {
		$root1 = self::convertArrayToTree([1,2,3]);
		$root2 = self::convertArrayToTree([1,3,2]);
		echo ($this->leafSimilar($root1,$root2) ? '1':'0').PHP_EOL;
    }
}

(new Solution())->test();