<?php

require_once 'base\AlgorithmBase.php';
// 金字塔转换矩阵-DFS
class Solution extends \algorithm\base\AlgorithmBase
{   	
	private $allow_map;
    private $map;
    function pyramidTransition($bottom, $allowed) {
		$this->map = [];
        $this->initAllowMap($allowed);
        return $this->dfs($bottom);
    }

    function initAllowMap($allowed){
        foreach($allowed as $a){
            $this->allow_map[substr($a,0,2)][] = substr($a,2); 
        }
        //print_r($this->allow_map);
    }

    function dfs($s){
        if(array_key_exists($s,$this->map))
            return $this->map[$s];
        if(strlen($s) == 1)
            return 1;
        $ans = [''];
        for($i = 0,$len = strlen($s);$i < $len-1;$i++){
            $cur = substr($s,$i,2);
            $map = $this->allow_map[$cur];
            if(empty($map)){
                $this->map[$s] = 0;
                return false;
            }
			$temp = [];
			foreach($ans as $index => $pre){
				foreach($map as $allow){
					$temp[] = $pre.$allow;
				}
			}
			$ans = $temp;
        }
        //print_r($ans);
        foreach($ans as $next){
            $res = $this->dfs($next);
            if($res){
                $this->map[$s] = 1;
                return true;
            }
        }
        $this->map[$s] = 0;
        return false;
    }

	function test(){
		echo( $this->pyramidTransition("CCC",
["CBB","ACB","ABD","CDB","BDC","CBC","DBA","DBB","CAB","BCB","BCC","BAA","CCD","BDD","DDD","CCA","CAA","CCC","CCB"])).PHP_EOL;
	}
}

(new Solution())->test();