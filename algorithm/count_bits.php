<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function countBits($num)
    {
        $result = [0];

        #region 动态规划 + 最后设置位 P(x)=P(x/2)+(x mod 2)
        for ($i = 1; $i <= $num; $i++) {
            $result[$i] = $result[$i >> 1] + ($i & 1); // x / 2 is x >> 1 and x % 2 is x & 1
        }
        #endregion

        #region 动态规划 + 最后设置位 P(x)=P(x&(x−1))+1;
//        for ($i = 1; $i <= $num; $i++) {
//            $result[$i] = $result[$i & $i - 1] + 1;
//        }
        #endregion

        #region 遍历
//        for ($i = 1; $i <= $num; $i++) {
//            $result[] = $this->pop_count($i);
//        }
        #endregion

        return $result;
    }

    /*求一个数二进制的1的个数
        * 算法思路：每次for循环，都将num的二进制中最右边的 1 清除。
      *为什么n &= (n – 1)能清除最右边的1呢？因为从二进制的角度讲，n相当于在n - 1的最低位加上1。
      * 举个例子，8（1000）= 7（0111）+ 1（0001），所以8 & 7 = （1000）&（0111）= 0（0000），
      * 清除了8最右边的1（其实就是最高位的1，因为8的二进制中只有一个1）。再比如7（0111）= 6（0110）+ 1（0001），
      * 所以7 & 6 = （0111）&（0110）= 6（0110），清除了7的二进制表示中最右边的1（也就是最低位的1）。*/
    private function pop_count($x)
    {
        for ($count = 0; $x != 0; ++$count)
            $x &= $x - 1; //zeroing out the least significant nonzero bit
        return $count;
    }

    //0     0
    //1     1
    //2    10
    //3    11
    //4   100
    //5   101
    function test()
    {
        print_r($this->countBits(3));
    }
}

(new Solution())->test();