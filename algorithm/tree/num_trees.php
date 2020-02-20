<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    function numTrees($n)
    {
        // F(i,n)=G(i−1)⋅G(n−i)
        // G(n)= 求和 G(i−1)⋅G(n−i)
        $f = [];
        $f[0] = 1;
        $f[1] = 1;
        $f[2] = 2;
        for ($i = 3; $i <= $n; $i++) {
            $f[$i] = 0;
            for ($j = 1; $j <= $i; $j++) {
                $f[$i] += ($f[$j - 1] * $f[$i - $j]);
            }
        }

        return $f[$n];
    }

    function test()
    {
        echo $this->numTrees(3) . PHP_EOL;
    }
}

(new Solution())->test();