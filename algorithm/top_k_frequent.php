<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function topKFrequent($nums, $k)
    {
        $mapping = [];
        foreach ($nums as $num) {
            $mapping[$num]++;
        }
        asort($mapping);
        $result = [];
        $i = 0;
        $keys = array_keys($mapping);
        while ($i++ < $k) {
            array_push($result, array_pop($keys));
        }
        return $result;
    }

    function test()
    {
        print_r($this->topKFrequent([1,1,1,2,2,3],2));
        print_r($this->topKFrequent([1],1));
    }
}

(new Solution())->test();