<?php

require_once 'base\AlgorithmBase.php';
// 爱生气的书店老板-滑动窗口
class Solution extends \algorithm\base\AlgorithmBase
{   
//滑动窗口
 function maxSatisfied($customers, $grumpy, $X) {
	 $base = 0;
	 $len = count($customers);
	 for($i = 0;$i < $len;$i++){
		 if($grumpy[$i] == 0){
			 $base += $customers[$i];
		 }
	 }
	 
	 $first = 0;
	 for($i = 0;$i < $X;$i++){
		 if($grumpy[$i] == 1){
			 $first += $customers[$i];
		 }
	 }
	 $max = $first;
	 for($i = $X;$i < $len;$i++){
		 $first = $first - $customers[$i-$X]*$grumpy[$i-$X] + $customers[$i]*$grumpy[$i];
		 $max = max($max,$first);
	 }
	 
	 return $base + $max;
 }
 
 //
    function maxSatisfied1($customers, $grumpy, $X) {
        $len = count($customers);
        $left = array_fill(0,$len,0);
        $right = array_fill(0,$len,0);
        $weights = array_fill(0,$len,0);
        for($i = 0;$i < $len;$i++){
            $cur = $grumpy[$i] == 0 ? $customers[$i] : 0;
            $left[$i] = $i == 0? $cur : $cur + $left[$i-1];
            $weights[$i] = $grumpy[$i] == 1 ? $customers[$i] : 0;
        }
        for($i = $len - 1;$i >= $X;$i--){
            $cur = $grumpy[$i] == 0 ? $customers[$i] : 0;
            $right[$i] = $i == $len-1 ? $cur : $cur + $right[$i+1];
        }
        $l = 0;
        $weight = 0;
		$max_index = -1;
        while($l <= $len - $X){
            $cur = array_sum(array_slice($weights,$l,$X));
            if($cur > $weight){
                $weight = $cur;
                $max_index = $l;
            }
           $l++;
        }
		//print_r($left);
		//print_r($right);
		//print_r($weights);
		// $max_index .PHP_EOL;
        if($max_index == -1)
            return $left[$len-1];
        $left_ans = $max_index > 0 ? $left[$max_index-1]:0;
		$right_ans = $max_index + $X - 1 < $len - 1 ?$right[$max_index+$X]:0;
        return $left_ans + array_sum(array_slice($customers,$max_index,$X)) + $right_ans;
    }

	function test(){
		echo( $this->maxSatisfied([4,10,10],[1,1,0],2)).PHP_EOL;
		echo( $this->maxSatisfied([1,0,1,2,1,1,7,5],[0,1,0,1,0,1,0,1],3)).PHP_EOL;		
		echo( $this->maxSatisfied([10,4],[0,1],2)).PHP_EOL;
	}
}

(new Solution())->test();