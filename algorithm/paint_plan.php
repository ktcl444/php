<?php

require_once 'base\AlgorithmBase.php';
//黑白方格棋-遍历
class Solution extends \algorithm\base\AlgorithmBase
{
    private $sub = [
        '0'=>1,
        '1'=>1,
        '2'=>2,
        '3'=>6,
        '4'=>24,
        '5'=>120,
        '6'=>720
    ];

    function paintingPlan($n, $k) {
		        if($k==0 || $k == $n*$n)return 1;
        $ans = 0;
        for($i = 0;$i <= $n;$i++){
            for($j = 0;$j <= $n;$j++){
                if($i*$n + $j * $n - $i*$j == $k){
					echo $i.' '.$j.PHP_EOL;
                    $ans += $this->helper($n,$i)*$this->helper($n,$j);
                }
            }
        }

        return $ans;
    }

    function helper($m,$n){
       // m*(m-1)*(m-2)…(m-n+1)/n!
       $res = 1;
       for($i = $m;$i >= $m-$n+1;$i--){
           $res *= $i;
       }
       return $res/$this->sub[$n];
    }
		

	function test(){
		echo($this->paintingPlan(2,4)).PHP_EOL;
	}
}

(new Solution())->test();