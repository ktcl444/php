<?php

namespace algorithm\tree;
require_once 'base\TreeAlgorithmBase.php';

use \algorithm\tree\base\TreeNode as TreeNode;
//二叉搜索树的最近公共祖先-迭代+父指针
class Solution extends \algorithm\tree\base\TreeAlgorithmBase
{
	#region 迭代
    public function LowestCommonAncestor(TreeNode $root, TreeNode $p, TreeNode $q)
    {
		$node = $root;
		$p_val = $p->val;
		$q_val = $q->val;
		while($node != null){
			$n_val = $node->val;
			if($p_val > $n_val && $q_val > $n_val){
				$node = $node->right;
			}elseif($p_val < $n_val && $q_val < $n_val){
				$node = $node->left;
			}else{
				return $node;
			}
		}
		
		return null;
		
	}
	#endregion
	
	    #region 父指针
    public function LowestCommonAncestor1(TreeNode $root, TreeNode $p, TreeNode $q)
    {
        $node_list = [];
        $parent_mapping = [];

        $parent_mapping[$root->val] = null;
        $node_list[] = $root;

        while (!array_key_exists($p->val, $parent_mapping) || !array_key_exists($q->val, $parent_mapping)) {
            $node = array_pop($node_list);
            if ($node->left != null) {
                $parent_mapping[$node->left->val] = $node;
                array_push($node_list, $node->left);
            }
            if ($node->right != null) {
                $parent_mapping[$node->right->val] = $node;
                array_push($node_list, $node->right);
            }
        }

        $parent_list = [];
        while ($p != null) {
            array_push($parent_list, $p->val);
            $p = $parent_mapping[$p->val];
        }

        while (!in_array($q->val, $parent_list)) {
            $q = $parent_mapping[$q->val];
        }

        return $q;
    }
    #endregion

	#region 递归
	    function lowestCommonAncestor($root, $p, $q) {
        if ($root === null) return null;
        if ($root->val === $p->val || $root->val === $q->val) return $root;
        $left = $this->lowestCommonAncestor($root->left, $p, $q);
        $right = $this->lowestCommonAncestor($root->right, $p, $q);
        if ($left === null) return $right;
        if ($right === null) return $left;
        if ($left !== null && $right !== null) return $root;
        return null;
    }
	#endregion
	
	#region 路径
	function lowestCommonAncestor2($root, $p, $q) {
        $res = $root;
        $p_path = $this->helper($root,$p);
        $q_path = $this->helper($root,$q);
        while(!empty($p_path) && !empty($q_path)){
            $p_parent = array_shift($p_path);
            $q_parent = array_shift($q_path);
            if($p_parent->val == $q_parent->val){
                $res = $p_parent;
            }else{
                break;
            }
        }

        return $res;
    }

    function helper($root,$find){
        if(is_null($root))return [];
        $res = [$root];
        if($root->val == $find->val)
            return $res;
        $left = $this->helper($root->left,$find);
        if(!empty($left))
            return array_merge($res,$left);
        $right = $this->helper($root->right,$find);
        if(!empty($right))
            return array_merge($res,$right);
    }
	#endregion

    function test()
    {

    }
}

(new Solution())->test();