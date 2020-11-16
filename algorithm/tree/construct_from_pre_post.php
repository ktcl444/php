<?php
namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;
//根据前序和后序遍历构造二叉树-递归
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	     private $_pre;
     private $_po;
	 private $_post_map;
      function constructFromPrePost($pre, $post) {
          $this->_pre = $pre;
          $this->_po = $post;
		  $this->_post_map = [];
		  foreach($post as $index => $val){
			  $this->_post_map[$val] = $index;
		  }
          return $this->dfs(0,0,count($pre));
      }
      function dfs($i0,$i1,$len){
		 // echo $i0.' '.$i1.' '.$len.PHP_EOL;
          if($len == 0)return null;
          $root = new TreeNode($this->_pre[$i0]);
          if($len == 1)return $root;

        $p_index = $this->_post_map[$this->_pre[$i0+1]];
		$n_len = $p_index - $i1 + 1;

        $root->left = $this->dfs($i0+1,$i1,$n_len);
        $root->right = $this->dfs($i0+$n_len+1,$i1+$n_len,$len - $n_len -1 );
        return $root;

      }
    function constructFromPrePost2($pre, $post) {
        $len = count($pre);
        if($len == 0)return null;
        $root = new TreeNode($pre[0]);
        if($len == 1)return $root;

        $left = 0;
        for($i = 0;$i < $len;$i++){
            if($pre[1] == $post[$i])
                $left = $i+1;
        }

        $root->left = $this->constructFromPrePost2(array_slice($pre,1,$left),array_slice($post,0,$left));
        $root->right = $this->constructFromPrePost2(array_slice($pre,$left+1),array_slice($post,$left,$len - $left-1));
        return $root;
    }

	function test(){
 		print_r($this->constructFromPrePost(
			[1,2,4,5,3,6,7],
[4,5,2,6,7,3,1]
		)).PHP_EOL; 
				print_r($this->constructFromPrePost(
		[9,10,6,1,4,2,3,7,8,5],
		[10,4,1,7,5,8,3,2,6,9]
		)).PHP_EOL;

	}
}

(new Solution())->test();