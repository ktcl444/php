<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function reconstructQueue($people)
    {
        usort($people, function ($a, $b) {
            return $a[0] == $b[0] ? $a[1] - $b[1] : $b[0] - $a[0];
        });
        $result = [];
        foreach ($people as $p) {
            array_splice($result, $p[1], 0, [$p]);
        }
        return $result;
    }

    function test()
    {
        print_r($this->reconstructQueue([[7, 0], [4, 4], [7, 1], [5, 0], [6, 1], [5, 2]]));
    }
}

(new Solution())->test();