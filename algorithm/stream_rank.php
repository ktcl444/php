<?php

require_once 'base\AlgorithmBase.php';
//数字流的秩-树状数组
class Solution extends \algorithm\base\AlgorithmBase
{     

	function test(){
		$obj = new StreamRank();
		$obj->track(2);
			$obj->track(1);
				$obj->track(3);
					$obj->track(2);
						$obj->track(4);
		echo $obj->getRankOfNumber(4).PHP_EOL;
		echo $obj->getRankOfNumber(3).PHP_EOL;
		echo $obj->getRankOfNumber(2).PHP_EOL;
		echo $obj->getRankOfNumber(1).PHP_EOL;
	}
}

class StreamRank {
    /**
     */
    private $list;
    function __construct() {
        $this->list = array_fill(0,50001,0);
    }

    /**
     * @param Integer $x
     * @return NULL
     */
    function track($x) {
        if($x == 0){
			$this->list[0]++;
		}else{
			while($x < count($this->list)){
				$this->list[$x]++;
				$x += $this->lowbit($x);
			}
		}
    }

    /**
     * @param Integer $x
     * @return Integer
     */
    function getRankOfNumber($x) {
        $sum = 0;
		while($x > 0){
			$sum += $this->list[$x];
			$x -= $this->lowbit($x);
		}
		return $sum += $this->list[0];
    }
	
	   function lowbit($x) {
    	return $x & (-$x);
    }
}

(new Solution())->test();