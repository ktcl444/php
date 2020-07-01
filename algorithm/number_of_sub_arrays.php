<?php

require_once 'base\AlgorithmBase.php';

//统计「优美子数组」
class Solution extends \algorithm\base\AlgorithmBase
{
	//数学(odd[i]−odd[i−1])∗(odd[i+k]−odd[i+k−1])
	function numberOfSubarrays($nums, $k) {
		$odd = [];
		$cnt = 0;
		foreach($nums as $index => $num){
			if($num % 2 == 1){
				$odd[++$cnt] = $index;
			}
		}
		$odd[0] = -1;
		$odd[++$cnt] = count($nums);
		
		$res = 0;
		$l = 1;
		$r = $l + $k;
		while($l + $k <= $cnt){
			$res += ($odd[$l] - $odd[$l - 1]) * ($odd[$l+ $k] - $odd[$l + $k -1]);
			$l++;
		}
		
		return $res;
	}
	
	//前缀和+差分
	function numberOfSubarrays1($nums, $k) {
		$n = count($nums);
		$cnt = array_fill(0,$n+1,0);
		$odd = 0;
		$ans = 0;
		$cnt[0] = 1;
		for($i = 0;$i < $n;$i++)
		{
			$odd += $nums[$i] & 1;
			$ans += $odd >= $k ? $cnt[$odd- $k] :0;
			$cnt[$odd] +=1;
		}
		
		print_r($cnt);
		
		return $ans;
	}
	
	//双指针(超时)
	function numberOfSubarrays2($nums, $k) {
        $length = count($nums);
        foreach($nums as $key => $num){
            if($num % 2 == 0){
                $nums[$key] = 0;
            }else{
                $nums[$key] = 1;
            }
        }
        $l = 0;
        $r = 0;
        $sum = 0;
        $res = 0;
        while($l < $length && $r < $length){
            $sum = array_sum(array_slice($nums,$l,$r-$l+1));
            if($sum < $k){
                $r++;
            }else if($sum == $k){
                $tempr = $r;
                while($r <= $length - 1 && $sum == $k){
                    $res++;
                    $sum += $nums[++$r];
                }
                $l++;
                $r = $tempr;
            }else{
                $l++;
            }
        }

        return $res;
    }
	
	function test(){
		echo ($this->numberOfSubarrays1([1,1,1,2,1,2],3)).PHP_EOL;
	}
}

(new Solution())->test();