<?php

require_once 'base\AlgorithmBase.php';
//棒球比赛-堆栈
class Solution extends \algorithm\base\AlgorithmBase
{

    function calPoints($ops) {
        $ans = [];
        foreach($ops as $s){
            switch($s){
                case '+':
                    $ans[] = $this->getPreTwo($ans);
                    break;
                case 'D':
                    $ans[] = $this->getDouble($ans);
                    break;
                case 'C':
                    $ans = $this->removeLast($ans);
                    break;
                default:
                    $ans[] = $s;
                    break;
            }
        }

		print_r($ans);
        return array_sum($ans);
    }

    private function removeLast($ans){
        if(!empty($ans)){
            array_splice($ans,count($ans) - 1,1);
        }

        return $ans;
    }

    private function getDouble($ans){
        return empty($ans) ? 0 : end($ans) * 2;
    }

    private function getPreTwo($ans){
        $len = count($ans)-1;
        $i = 0;
        $res = 0;
        while($i < 2 && $len >= 0){
            $res += $ans[$len--];
            $i++;
        }

        return $res;
    }

  
	function test(){
		echo($this->calPoints(["5","2","C","D","+"])).PHP_EOL;
	}
}

(new Solution())->test();