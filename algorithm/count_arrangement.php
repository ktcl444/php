<?php

require_once 'base\AlgorithmBase.php';
//优美的排列-回溯
class Solution extends \algorithm\base\AlgorithmBase
{      public $count ;
	private $ans;
	function countArrangement($N) {
		$this->count = 0;
		$this->ans = [];
        $visited = array_fill(1, $N, false);
        $step = 1;
        $this->backtrack($N, $visited, $step,[]);
		//print_r($this->ans);
        return $this->count;
    }


    function backtrack($n, $visited, $step,$list) {
        if ($step > $n) {
            $this->count += 1;
			$this->ans[] = $list;
            return;
        }

        for ($i = 1; $i <= $n; $i++) {
            if (!$visited[$i] && ($step % $i == 0 || $i % $step == 0)) {
				$visited[$i] = true;
				$list[] = $i;
				$this->backtrack($n, $visited, $step+1,$list);
			    $visited[$i] = false;
				array_pop($list);
            }
        }
    }
	
	//错误
    function countArrangement2($N) {
        $list = [[1]];
        for($i = 2;$i <= $N;$i++){
            $new_list= [];
            foreach($list as $c){
               // print_r($c);
                $clone =  $c;
                $len = count($c);
                foreach($c as $index => $num){
                    if(($num % $i ==0 || $i % $num == 0)&&($i % ($index+1)==0 || ($index+1)%$i==0)){

					//echo '111'.PHP_EOL;                       
					   $c[$index] = $i;
                        $c[] = $num;
                        $new_list[] = $c;
                        $c[$index] = $num;
                        array_pop($c);
                    }
                }
                array_push($c,$i);
                $new_list[] = $c;
            }
            $list = $new_list;
        }
		print_r($list);
        return count($list);
    }
		

	function test(){
		echo($this->countArrangement(6)).PHP_EOL;
		//echo($this->countArrangement(2)).PHP_EOL;
		//echo($this->countArrangement(3)).PHP_EOL;
		//echo($this->countArrangement(4)).PHP_EOL;
		//echo($this->countArrangement(5)).PHP_EOL;
	}
}

(new Solution())->test();