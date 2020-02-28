<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
//    function findKthLargest($nums, $k)
//    {
//        rsort($nums);
//        return $nums[$k-1];
//    }

    #region 快速选择
    public function findKthLargest($nums, $k)
    {
        $n = count($nums);
        $l = 0;
        $r = $n - 1;

        // 第 n 大就是第 n-k 小
        $target = $n - $k;
        while (true) {
            $index = $this->partition($nums, $l, $r);
            if ($index == $target) {
                return $nums[$index];
            } else if ($target > $index) {
                $l = $index + 1;
            } else {
                $r = $index - 1;
            }
        }
    }

    public function partition(array &$nums, $l, $r)
    {
        $rand = rand($l, $r);
        $this->swap($nums,$r,$rand);

        $pivot = $nums[$r];
        $border = $l;
        for ($i = $l; $i < $r; $i++) {
            if ($nums[$i] < $pivot) {
                if ($border != $i) {
                    $this->swap($nums, $i, $border);
                }
                $border++;
            }
        }

        // 将 povit 放到中间
        $this->swap($nums,$border,$r);

        return $border;
    }

    public function swap(array &$nums, $index1, $index2)
    {
        $tmp = $nums[$index1];
        $nums[$index1] = $nums[$index2];
        $nums[$index2] = $tmp;
    }
    #endregion

    function test()
    {
        print_r($this->findKthLargest([-1, -1], 2));
        print_r($this->findKthLargest([3, 2, 1, 5, 6, 4], 2));
        print_r($this->findKthLargest([3, 2, 3, 1, 2, 4, 5, 5, 6], 4));
    }
}

(new Solution())->test();