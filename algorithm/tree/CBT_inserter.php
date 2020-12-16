<?php
namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;
//完全二叉树插入器-迭代
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{

  
    /**
     * @return TreeNode
     */
    function get_root() {
       // print_r($this->root);
        return $this->root;
    }
	function test(){
		$root = self::convertArrayToTree([1,2]);
		$obj = new CBTInserter($root);
		echo $obj->insert(3).PHP_EOL;
		echo $obj->insert(4).PHP_EOL;
		echo $obj->insert(5).PHP_EOL;
		echo $obj->insert(6).PHP_EOL;
		print_r($obj->get_root());

	}
}
class CBTInserter
{
	private $root;
    private $list;
    function __construct($root) {
        $this->root = $root;
        $this->dfs([$root]);
    }

    function dfs($list){
        while(!empty($list)){
            $node = array_shift($list);
            if(empty($node->left) || empty($node->right)){
                $this->list[] = $node;
            }
			if(!empty($node->left) && !empty($node->right)){
				$list[] = $node->left;
                $list[] = $node->right;
			}
        }
		//print_r($this->list);
    }
  
    /**
     * @param Integer $v
     * @return Integer
     */
    function insert($v) {
        $node = array_shift($this->list);
        $new_node = new TreeNode($v);
        if(empty($node->left)){
            $node->left = $new_node;
        }else if(empty($node->right)){
            $node->right = $new_node;
        }
        if(empty($node->left) || empty($node->right)){
            array_unshift($this->list,$node);
        }
		if(!empty($node->left) && !empty($node->right)){
				$this->list[] = $node->left;
                $this->list[] = $node->right;
		}
          
        //echo 'insert:'.$v.PHP_EOL;
       // print_r($this->list);
       // print_r($this->root);
        return $node->val;
    }	
	
	    function get_root() {
       // print_r($this->root);
        return $this->root;
    }
}

(new Solution())->test();