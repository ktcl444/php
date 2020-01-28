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
        $stack = [$t1];
        while (!empty($stack)) {
            $node = array_pop($stack);
            $temp = $node->left;
            $node->left = $node->right;
            $node->right = $temp;
            if (!is_null($node->left)) {
                array_push($stack, $node->left);
            }
            if (!is_null($node->right)) {
                array_push($stack, $node->right);
            }
        }

        return $t1;
    }

    function test()
    {
        $t1 = self::convertArrayToTree([1, 2, 3]);
        $t2 = self::convertArrayToTree([3, 2, 1]);
        print_r($this->invertTree($t1));
        print_r($this->invertTree($t2));
    }
}

(new Solution())->test();