<?php
namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;
//不同的二叉搜索树-递归
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
     private $map;
    function generateTrees($n) {
        if($n == 0)return [];
        $this->map = [];
        return $this->dfs(1,$n);
    }

    function dfs($s,$e){
		$ans = [];
		if($e < $s){
			$ans[] = null;
		}else{
            if(array_key_exists($s.':'.$e,$this->map)){
                return $this->map[$s.':'.$e];
            }
        }


        for($i = $s; $i <= $e;$i++){
            $left_list = $this->dfs($s,$i-1);
            $right_list = $this->dfs($i+1,$e);
            foreach($left_list as $left){
				foreach($right_list as $right){
					$root = new TreeNode($i);
					$root->left = $left;
					$root->right = $right;
					$ans[] = $root;
				}
			}
        }

        $this->map[$s.':'.$e] = $ans;
        return $ans;
    }
	function test(){
 		print_r($this->generateTrees([3,2,4,1]));

	}
}

(new Solution())->test();