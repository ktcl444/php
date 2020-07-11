<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;

//递增顺序查找树	
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
   private $ans;
    function increasingBST($root) {
        $head = new TreeNode(0);
        $this->ans = $head;
        $this->helper($root);
        return $head->right;
    }

    function helper($root){
        if(empty($root))return;
        $this->helper($root->left);

        $node = new TreeNode($root->val);
        $this->ans->right = $node;
        $this->ans = $node;

        $this->helper($root->right);
    }
    function test()
    {
		print_r($this->increasingBST(self::convertArrayToTree([5,3,6,2,4,null,8,1,null,null,null,7,9])));
    }
}

(new Solution())->test();