<?php

require_once 'base\AlgorithmBase.php';
//连通网络的操作次数-并查集
class Solution extends \algorithm\base\AlgorithmBase
{   
	function makeConnected($n, $connections) {
        $len = count($connections);
        if($len < $n - 1)return -1;
        $helper = new PCHelper($n);
        foreach($connections as $c){
            $helper->merge($c[0],$c[1]);
        }

        return $helper->cal();
    }

	function test(){
		echo ($this->makeConnected(4,[[0,1],[0,2],[1,2]])).PHP_EOL;		
		echo ($this->makeConnected(5,[[0,1],[0,2],[3,4],[2,3]])).PHP_EOL;		
		echo ($this->makeConnected(8,[[0,2],[2,7],[5,7],[2,6],[1,3],[4,6],[1,2]])).PHP_EOL;
		echo ($this->makeConnected(8,[[0,6],[2,3],[2,6],[2,7],[1,7],[2,4],[3,5],[0,2]])).PHP_EOL;
	}
}

class PCHelper{
    public $parent;
	public $sub;
	public $len;
	public $conn;

    public function __construct($n){
        $this->parent = range(0,$n-1);
		$this->len = $n;
		$this->sub = array_fill(0,$n,1);
		$this->conn = $n;
    }

    public function find($no){
        $parent = $this->parent[$no];
        while($parent != $no){
            $no = $parent;
            $parent = $this->parent[$no];
        }

        return $parent;
    }

    public function merge($a,$b){
        $parent_a = $this->find($a);
        $parent_b = $this->find($b);
        if($parent_a != $parent_b){
            if($this->sub[$parent_b] > $this->sub[$parent_a]){
                [$parent_a,$parent_b] = [$parent_b,$parent_a];
            }
            $this->parent[$parent_b] = $parent_a;
			$this->sub[$parent_a]++;
			$this->conn--;
        }
    }
	
	public function cal(){
		return  $this->conn - 1;
	}
}

(new Solution())->test();