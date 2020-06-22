<?php

require_once 'base\AlgorithmBase.php';

//格雷码-镜像反射
/* 设 nn 阶格雷码集合为 G(n)G(n)，则 G(n+1)G(n+1) 阶格雷码为：
给 G(n)G(n) 阶格雷码每个元素二进制形式前面添加 00，得到 G'(n)G 
′
 (n)；
设 G(n)G(n) 集合倒序（镜像）为 R(n)R(n)，给 R(n)R(n) 每个元素二进制形式前面添加 11，得到 R'(n)R 
′
 (n)；
G(n+1) = G'(n) ∪ R'(n)G(n+1)=G 
′
 (n)∪R 
′
 (n) 拼接两个集合即可得到下一阶格雷码。 */
class Solution extends \algorithm\base\AlgorithmBase
{    
	function grayCode($n){
		$res = [0];
		$head = 1;
		for($i = 1;$i <=$n;$i++){
			for($j = count($res)-1;$j>=0;$j--)
				$res[] = $res[$j] + $head;
			$head <<= 1;
		}
		
		return $res;
	}
	
	function test(){
		print_r ($this->grayCode(3));
	}
	
}
(new Solution())->test();