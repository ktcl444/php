<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function findDuplicate($nums)
    {
        $tortoise = $nums[0];
        $hare = $nums[0];
        do {
            $tortoise = $nums[$tortoise];
            $hare = $nums[$nums[$hare]];
        } while ($tortoise != $hare);

        // Find the "entrance" to the cycle.
        $ptr1 = $nums[0];
        $ptr2 = $tortoise;
        while ($ptr1 != $ptr2) {
            $ptr1 = $nums[$ptr1];
            $ptr2 = $nums[$ptr2];
        }

        return $ptr1;
//        $length = count($nums);
//        $mapping = [];
//        for ($i = 0; $i < $length; $i++) {
//            if (array_key_exists($nums[$i], $mapping)) {
//                return $nums[$i];
//            } else {
//                $mapping[$nums[$i]] = 1;
//            }
//        }
//
//        return 0;
    }

    function test()
    {
        echo $this->findDuplicate([1, 3, 4, 2, 2]) . PHP_EOL;
    }
}

(new Solution())->test();