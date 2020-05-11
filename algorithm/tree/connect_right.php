<?php

require_once 'base\AlgorithmBase.php';

//完美二叉树:填充每个节点的下一个右侧节点指针-两种next+BFS
class Solution extends \algorithm\base\AlgorithmBase
{
	//广度遍历
	public function connect2($root){
		$stack = [$root];
		while(count($stack) > 0){
			$size = count($stack);
			for($i = 0;$i < $size;$i++){
				$node = array_shift($stack);
				if($i < $size - 1){
					$node->next = current($stack);
				}
				if(!is_null($node->left)){
					$stack[] = $node->left;
				}
				if(!is_null($node->right)){
					$stack[] = $node->right;
				}
			}
		}
		
		return $root;
	}
	//两种next
    public function connect($root) {
        if(is_null($root))return null;
        $temp = $root;
        while($temp->left != null){
            $head = $temp;
            while($head != null){
                $head->left->next = $head->right;
                if(!is_null($head->next)){
                    $head->right->next = $head->next->left;
                }
                $head = $head->next;
            }
            $temp = $temp->left;
        }
       
        return $root;
    }
	
	function test(){

	}
	
	class Node {
		function __construct($val = 0) {
          $this->val = $val;
          $this->left = null;
          $this->right = null;
          $this->next = null;
		}
	}
}

(new Solution())->test();