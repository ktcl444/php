<?php

require_once 'base\AlgorithmBase.php';

//数组中的逆序对-归并排序
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 归并排序
	private $res = 0;
	 function reversePairs($nums) {
		 $this->mergeSort($nums,0,count($nums) - 1);
		 return $this->res;
	 }
	 
	 function mergeSort(&$nums,$l,$r){
		 if($l >= $r)return;
		 $mid = ($l + $r)>>1;
		 $this->mergeSort($nums,$l,$mid);
		 $this->mergeSort($nums,$mid + 1,$r);
		 $this->merge($nums,$l,$mid,$r);
	 }
	 
	 function merge(&$nums,$l,$mid,$r){
		 $p1 = $l;
		 $p2 = $mid+1;
		 $temp = [];
		 
		 while($p1 <= $mid && $p2 <= $r){
             if($nums[$p1] > $nums[$p2]){
                $this->res += $mid - $p1 +1;
                $temp[] = $nums[$p2++];
             }else{
                $temp[] = $nums[$p1++];
             }
		 }
		 
		 while($p1 <= $mid){
			 $temp[] = $nums[$p1++];
		 }
		 
		 while($p2 <= $r){
			 $temp[] = $nums[$p2++];
		 }
		for ($k = $l; $k <= $r; $k++) {
			$nums[$k] = $temp[$k-$l];
		}
	 }
	 #endregion
	
	#region 暴力
    function reversePairs1($nums) {
        $length = count($nums);
        $l = 0;
        $r = 1;
        $ans = 0;
        while($l < $length && $r < $length){
            if($nums[$l] > $nums[$r]){
                $ans++;
            }
            if($r == $length - 1){
                $l++;
                $r = $l;
            }
            $r++;
        }

        return $ans;
    }
	#endregion
	
	
	function test(){
		echo($this->reversePairs( [4,5,6,7])).PHP_EOL;
	}
}

(new Solution())->test();