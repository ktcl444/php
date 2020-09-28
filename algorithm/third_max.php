<?php

require_once 'base\AlgorithmBase.php';
//第三大的数-堆/冒泡三次/堆栈
class Solution extends \algorithm\base\AlgorithmBase
{
	//堆
	    function thirdMax($nums)
    {
        $n = count($nums);
        if ($n < 3) return max($nums);
        $hash = [];
        $heap = new SplMaxHeap();
        foreach ($nums as $num) {
            if (isset($hash[$num])) continue;
            $hash[$num] = true;
            $heap->insert($num);
        }

        // $this->dumpHeap($heap);
        if ($heap->count() >= 3) {
            $i = 0;
            while ($heap->valid()) {
                if ($i == 2) {
                    return $heap->current();
                }
                $heap->next();
                $i++;
            }
        }
        return $heap->top();
    }
	//冒泡排序3次
	    function thirdMax1($nums) {
        $nums = array_values(array_unique($nums));
    
        $count = count($nums) - 1;
        if ($count >= 2) {
            $c = 3;
        } else {
            $c = 1;
        }
        for ($i = 0; $i < $c; $i++) {
            for ($j = 0; $j < $count - $i; $j++) {
                if ($nums[$j] > $nums[$j + 1]) {
                    $tem = $nums[$j + 1];
                    $nums[$j + 1] = $nums[$j];
                    $nums[$j] = $tem;
                }
            }
        }
        return $nums[$count - 2] ?? $nums[$count];
    }
	//堆栈
    function thirdMax2($nums) {
        $stack = [PHP_INT_MIN,PHP_INT_MIN,PHP_INT_MIN];
        foreach($nums as $num){
            if(empty($stack)){
                $stack[] = $num;
            }else{
                $i = 0;
                while($i< count($stack) && $num >= $stack[$i]){
                    if($num == $stack[$i]){
                        $i=0;
                        break;
                    }else{
                        $i++;
                    }
                }
                if($i > 0){
                    $place = $i - 1;
                    $pre = $stack[$place];
                    $stack[$place] = $num;
                    while($place>0){
						$temp = $stack[$place-1];
                        $stack[$place -1]=$pre;
						$pre = $temp;
                        $place--;
                    }
                }
            }
        }
        return $stack[0] == PHP_INT_MIN ? $stack[2]:$stack[0];
    }
		

	function test(){
		echo($this->thirdMax([1,2])).PHP_EOL;
	}
}

(new Solution())->test();