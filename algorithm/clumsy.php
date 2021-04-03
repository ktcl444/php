<?php

require_once 'base\AlgorithmBase.php';
//统计只差一个字符的子串数目-暴力
class Solution extends \algorithm\base\AlgorithmBase
{    //数学
function clumsy($N) {
	$ans = [1,2,6,7];
	if($N<=4){
		return $ans[$N-1];
	}else{
		$mod = $N%4;
		if($mod == 0){
			return $N+1;
		}else if($mod <= 2){
			return $N+2;
		}else{
			return $N-1;
		}
	}
}
	//堆栈
	function clumsy1($N) {
        $stack = [$N];
		$N--;
		$cur = 0;
		while($N>0){
			if($cur % 4 == 0){
				$stack[] = array_pop($stack)*$N;
			}else if($cur % 4 == 1){
				$temp = array_pop($stack)/$N;
				if($temp >= 0){
					$temp = floor($temp);
				}else{
					$temp = ceil($temp);
				}
				$stack[] = $temp;
			}else if($cur % 4 == 2){
				$stack[] = $N;
			}else{
				$stack[] = -$N;
			}
			$cur++;
			$N--;
		}
		$ans = 0;
		while(!empty($stack)){
			$ans += array_pop($stack);
		}
		return $ans;
    }

	//暴力
    function clumsy2($N) {
        $list  = [];
        for($i = $N;$i >= 1;$i--){
            $list[] = $i;
        }
        $ans = 0;
        $list = array_chunk($list,4);
        //print_r($list);
        foreach($list as $index => $cur){
                $ans += $this->cal($cur,$index == 0);
        }

        return $ans;
    }

    function cal($list,$first = false){
        $list = array_chunk($list,3);
        $one = $list[0][0];
        $two = count($list) == 2? $list[1][0]:0;
        $sign = ['*','/'];       
        for($i = 1,$len = count($list[0]);$i<$len;$i++){
            switch($sign[$i-1]){
                case '*':
                    $one *= $list[0][$i];
                    break;
                case '/':
                    $one = floor($one / $list[0][$i]);
                    break;
            }
        }

        $ans = $first ? $one + $two : -$one + $two;
		//echo $ans.PHP_EOL;
		return $ans;
    }

	function test(){
		echo ($this->clumsy(4)).PHP_EOL;
		echo ($this->clumsy(10)).PHP_EOL;
		echo ($this->clumsy(10000)).PHP_EOL;
	}
}

(new Solution())->test();