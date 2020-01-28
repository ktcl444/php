<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

class Solution extends \algorithm\tree\base\TreeAlgorithmBase{
    function maxDepth($root) {
        if(is_null($root))
        {
            return 0;
        }
        $deep = 1;
		$stack = [[$root,$deep]];
        while(!empty($stack)){
            $node = array_shift($stack);
			if(is_null($node[0]))continue;
			$deep = max($deep,$node[1]);
			if(!is_null($node[0]->left))
			array_push($stack,[$node[0]->left,$deep+1]);
            if(!is_null($node[0]->right))
			array_push($stack,[$node[0]->right,$deep+1]);
        }
        return $deep;
	}
	
    function test()
    {
        $root = self::convertArrayToTree([0,2,4,1,-3,3,-1,5,1,6,8]);
        print_r($this->maxDepth($root));
    }
}

(new Solution())->test();