<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';


class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    function rob($root)
    {
        $result = $this->rob_internal($root);
        return max($result[0], $result[1]);
    }

    function rob_internal($root)
    {
        if (is_null($root)) return [0, 0];
        $result = [0, 0];
        $left = $this->rob_internal($root->left);
        $right = $this->rob_internal($root->right);

        //0表示不偷
        $result[0] = max($left[0], $left[1]) + max($right[0], $right[1]);
        //1表示偷
        $result[1] = $left[0] + $right[0] + $root->val;

        return $result;
    }

    function test()
    {
        print_r($this->rob(self::convertArrayToTree([3, 2, 3, null, 3, null, 1])));
    }
}

(new Solution())->test();