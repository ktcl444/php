<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
    #region 递归1 保存路径节点
    function pathSum($root, $sum)
    {
        return $this->pathSum2($root, $sum, [], 0);
    }

    public function pathSum2($root, $sum, $array/*保存路径*/, $p/*指向路径终点*/)
    {
        if ($root == null) {
            return 0;
        }

        $tmp = $root->val;
        $n = $root->val == $sum ? 1 : 0;
        for ($i = $p - 1; $i >= 0; $i--) {
            $tmp += $array[$i];
            if ($tmp == $sum) {
                $n++;
            }
        }
        $array[$p] = $root->val;
        $n1 = $this->pathSum2($root->left, $sum, $array, $p + 1);
        $n2 = $this->pathSum2($root->right, $sum, $array, $p + 1);
        return $n + $n1 + $n2;
    }
    #endregion

    #region 递归2 差等判断
    function pathSum3($root, $sum) {
        if($root == null){
            return 0;
        }
        return $this->paths($root, $sum) + $this->pathSum($root->left, $sum) + $this->pathSum($root->right, $sum);
    }

    function paths($root, $sum){
        if($root == null){
            return 0;
        }
        $res = 0;
        if($root->val == $sum){
            $res += 1;
        }
        $res += $this->paths($root->left, $sum - $root->val);
        $res += $this->paths($root->right, $sum - $root->val);
        return $res;
    }
    #endregion

    function test()
    {
        $root = self::convertArrayToTree([10, 5, -3, 3, 2, null, 11, 3, -2, null, 1]);
        print_r($this->pathSum($root, 8));
    }
}

(new Solution())->test();