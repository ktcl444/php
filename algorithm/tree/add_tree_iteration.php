<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    function mergetrightees($t1, $t2)
    {
        if ($t1 == null) {
            return $t2;
        }
        if ($t2 == null) {
            return $t1;
        }

        $stack = [];
        array_push($stack, [$t1, $t2]);

        while (!empty($stack)) {
            $trees = array_pop($stack);

            $tleft = $trees[0];
            $tright = $trees[1];
            if (is_null($tleft) || is_null($tright)) {
                continue;
            }
            $tleft->val = ($tleft->val ?: 0) + ($tright->val ?: 0);
            if (is_null($tleft->left)) {
                $tleft->left = $tright->left;
            } else {
                array_push($stack, [$tleft->left, $tright->left]);
            }
            if (is_null($tleft->right)) {
                $tleft->right = $tright->right;
            } else {
                array_push($stack, [$tleft->right, $tright->right]);
            }
        }

        return $t1;
    }

    function test()
    {
        $t1 = self::convertArrayToTree([1, 2, 3]);
        $t2 = self::convertArrayToTree([3, 2, 1]);
        print_r($this->mergetrightees($t1, $t2));
    }
}

(new Solution())->test();

