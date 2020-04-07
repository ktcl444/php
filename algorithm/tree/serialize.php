<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';
use \algorithm\tree\base\TreeNode as TreeNode;

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	const SPLIT_STRING = ',';
	const NULL_STRING = 'null';
	/**
     * @param TreeNode $root
     * @return String
     */
    function serialize($root) {
       // if(is_null($root))return '';
		return $this->internal_serialize($root,'');
    }
	
	function internal_serialize($node,$str)
	{
		if(is_null($node))
		{
			$str = $str . 'null,';
		}else
		{
			$str = $str.$node->val.',';
			$str =  $this->internal_serialize($node->left,$str);
			$str =  $this->internal_serialize($node->right,$str);
		}
		
		return $str;
	}
  
    /**
     * @param String $data
     * @return TreeNode
     */
    function deserialize($data) {
        $a = explode(',',$data);
		return $this->internal_deserialize($a);
    }
	
	function internal_deserialize(&$a)
	{
		if( $a[0] == 'null'){
			array_shift($a);
			return null;
		}
		
		$s = array_shift($a);
		$root = new TreeNode($s);
		$root->left = $this->internal_deserialize($a);
		$root->right = $this->internal_deserialize($a);
		
		return $root;
	}
	
	function test(){
		$root = self::convertArrayToTree([1,2,3,null,null,4,5]);
		$string = $this->serialize($root);
		echo $string.PHP_EOL;
		
		print_r( $this->deserialize($string));
		
	}
}

(new Solution())->test();