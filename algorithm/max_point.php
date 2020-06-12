<?php

require_once 'base\AlgorithmBase.php';

//直线上最多的点
class Solution extends \algorithm\base\AlgorithmBase
{
	private $points = [];
	private $horisontal_lines = 0;
	private $lines = [];
	private $n = 0;
	 function maxPoints($points) {
		$this->points = $points;
		$this->n = count($points);
		if($this->n < 3)return $this->n;
		
		$max = 1;
		for($i = 0;$i < $this->n - 1;$i++){
			$max = max($this->helper($i),$max);
			//print_r($this->lines);
		}
		
		return $max;
    }
	
	function helper($i){
		$this->lines = new HashTable();
		$this->horisontal_lines = 1;
		$count = 1;
		$duplicates = 0;
		for($j = $i+1;$j<$this->n;$j++){
			$temp = $this->add_line($i,$j,$count,$duplicates);
			$count = $temp[0];
			$duplicates = $temp[1];
		}
		
		return $count + $duplicates;
	}
	
	function add_line($i,$j,$count,$duplicates){
		$x1 = $this->points[$i][0];
		$y1 = $this->points[$i][1];
		$x2 = $this->points[$j][0];
		$y2 = $this->points[$j][1];
		if($x1 == $x2 && $y1 == $y2)
			$duplicates++;
		elseif($x1 == $x2){
			$this->horisontal_lines++;
			$count = max($count,$this->horisontal_lines);
		}else{
			$key = bcdiv($y2-$y1,$x2 - $x1,18);
			$value = $this->lines->find($key);
			if(is_null($value)){
				$this->lines->insert($key,2);
			}else{
				$this->lines->insert($key,$value + 1);
			}
			$count = max($count,$this->lines->find($key));
		}
			
		return [$count,$duplicates];
	}

	
	function test(){

	 	echo($this->maxPoints([[1,1],[2,2],[3,3]])).PHP_EOL;
		echo($this->maxPoints( [[1,1],[3,2],[5,3],[4,1],[2,3],[1,4]])).PHP_EOL;
		
		echo($this->maxPoints( [[-4,1],[-7,7],[-1,5],[9,-25]])).PHP_EOL; 
		echo($this->maxPoints( [[0,0],[94911150,94911151],[94911151,94911152]])).PHP_EOL;
		
		
	}
}

class HashTable{
    private $buckets;
    private $size = 10;
    public function __construct()
    {
        $this->buckets = new SplFixedArray($this->size);
    }

    private function hash_func($key)
    {
        $strlen = strlen($key);
        $hash_val = 0;
        for ($i=0;$i<$strlen;$i++){
            $hash_val += ord($key[$i]);
        }
        return $hash_val%$this->size;
    }

    public function insert($key,$val)
    {
        $index = $this->hash_func($key);
        if(isset($this->buckets[$index])){
            $new_code = new HashNode($key,$val,$this->buckets[$index]);
        }else{
            $new_code = new HashNode($key,$val,null);
        }
        $this->buckets[$index] = $new_code;
    }

    public function find($key)
    {
        $index = $this->hash_func($key);
        $current = $this->buckets[$index];
        while (isset($current)) {
            if ($current->key == $key){
                return $current->value;
            }
            $current = $current->next_node;
        }
        return null;
    }
}

class HashNode{
    public $key;
    public $value;
    public $next_node;
    public function __construct($key,$value,$next_node=null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->next_node = $next_node;
    }

}

(new Solution())->test();