<?php
namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    function mergeTrees($t1, $t2) {
        if($t1 == null && $t2 == null){
            return null;
        }

        $val = ($t1->val?:0)+($t2->val?:0);
        $node = new \algorithm\tree\base\TreeNode($val);
        $node->left = $this->mergeTrees($t1->left?:null,$t2->left?:null);
        $node->right =  $this->mergeTrees($t1->right?:null,$t2->right?:null);

        return $node;
    }

    function test()
    {
        $t1 = self::convertArrayToTree([1, 2, 3]);
        $t2 = self::convertArrayToTree([3, 2, 1]);
        print_r( $this->mergeTrees($t1,$t2));
    }
}
(new Solution())->test();
	
