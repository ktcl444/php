<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    function invertTree($t1)
    {
        if ($t1 == null) {
            return $t1;
        }
        $temp_left = $t1->left;
        $temp_right = $t1->right;
        $t1->left = $this->invertTree($temp_right);
        $t1->right = $this->invertTree($temp_left);

        return $t1;
    }

    function test()
    {
        $t1 = self::convertArrayToTree([1, 2, 3]);
        $t2 =self::convertArrayToTree([3, 2, 1]);
        print_r($this->invertTree($t1));
        print_r($this->invertTree($t2));
    }
}

(new Solution())->test();

