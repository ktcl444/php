<?php

namespace algorithm\bit;
require_once '..\base\AlgorithmBase.php';

//数组中两个数的最大异或值-二进制前缀树
class Solution extends \algorithm\base\AlgorithmBase
{
      function findMaximumXOR($nums) {
          $max = max($nums);
          $max_l = strlen(decbin($max));
          $bit_list = [];
          foreach($nums as $num){
              $bit_list[] = str_pad(decbin($num),$max_l,0,STR_PAD_LEFT);
          }
          $root = new BitTreeNode();
          $ans = 0;
          foreach($bit_list as $list){
              $node = $bit_node = $root;
              $cur_bit = 0;
              for($i = 0;$i < $max_l;$i++){
                  $bit = $list[$i];
                  if(array_key_exists($bit,$node->children)){
                      $node = $node->children[$bit];
                  }else{
                      $child = new BitTreeNode();
                      $node->children[$bit] = $child;
					  $node = $child;
                  }
				  
				  $toggle_bit = $bit == '1' ? '0' : '1';
				  if(array_key_exists($toggle_bit,$bit_node->children)){
					  $cur_bit = ($cur_bit << 1) | 1;
					  $bit_node = $bit_node->children[$toggle_bit];
				  }else{
					  $cur_bit  = $cur_bit << 1;
					  $bit_node = $bit_node->children[$bit];
				  }
              }
			  $ans = max($ans,$cur_bit);
          }
		  return $ans;
      }
	  
	
	function test(){
		echo $this->findMaximumXOR( [3, 10, 5, 25, 2, 8]).PHP_EOL;
	}
}

class BitTreeNode{
    public $children;
    public function __construct(){
		$this->children = [];
    }   
}

(new Solution())->test();