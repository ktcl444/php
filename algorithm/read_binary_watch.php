<?php

require_once 'base\AlgorithmBase.php';
//二进制手表-二进制1的个数/回溯
class Solution extends \algorithm\base\AlgorithmBase
{    
     //二进制1的个数
     private $map;
    function readBinaryWatch($num) {
        $ans = [];
		$this->map = [];
		//print_r($this->map);
        for($i = 0;$i < 12;$i++){
            for($j = 0;$j < 60;$j++){
                $count = $this->getBitCount($i) + $this->getBitCount($j);
                if($count == $num){
                    $ans[] = sprintf('%d:%02d',$i,$j);
                }
            }
        }
		//print_r($this->map);
        return $ans;
    }

    function getBitCount($n){
		       if(array_key_exists($n,$this->map))
            return $this->map[$n];
        $ans = 0;
		$temp = $n;
        while($temp > 0){
            if($temp & 1 == 1){
                $ans++;
            }
            $temp = $temp >> 1;
        }
		//echo $temp.' '.$ans.PHP_EOL;
        $this->map[$n] = $ans;
        return $ans;
    }

    private $mins;
    private $ans;
    //回溯
    function readBinaryWatch1($num) {
        $this->mins = [];
        $this->ans = [];
        for($i = 0;$i < 6 && $num >= $i;$i++){
            $this->dfs(0,0,$i,true);
            $this->dfs(0,0,$num-$i,false);
            $this->mins = [];
        }

        return $this->ans;
    }

	//start 开始位置
	//sum 当前和
	//count 剩下个数
	//is_min 是否分钟
    function dfs($start,$sum,$count,$is_min){
        if($count == 0){
            if($is_min){
                $this->mins[] = $sum;
            }else{
                if(!empty($this->mins)){
                    //print_r($this->mins);
                    foreach($this->mins as $min){
						echo $sum.' '.$min.PHP_EOL; 
                        $this->ans[] = sprintf('%d:%02d',$sum,$min);
                    }
                }
                //else{
                   //  $this->ans = sprintf('%d:%02d',$sum,0);
                //}
            }
        }else{
            for($i = $start;$i < $is_min ? 6 : 4;$i++){
                $cur = pow(2,$i);
                if(($is_min && $sum + $cur >= 60)||(!$is_min && $sum + $cur >= 12))
                break;
                $this->dfs($i+1,$sum+$cur,$count-1,$is_min);
            }
        }
    }

	function test(){
		print_r($this->readBinaryWatch(1));
	}
}

(new Solution())->test();