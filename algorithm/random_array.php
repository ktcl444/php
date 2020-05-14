<?php

//打乱数组
class Solution
{
	private $original = [];
    /**
     * @param Integer[] $nums
     */
    function __construct($nums) {
        $this->original = $nums;
    }
  
    /**
     * Resets the array to its original configuration and return it.
     * @return Integer[]
     */
    function reset() {
        return $this->original;
    }
	
	function swap(&$array,$i,$j){
		$temp = $array[$i];
		$array[$i]= $array[$j];
		$array[$j] = $temp;
	}
  
    /**
     * Returns a random shuffling of the array.
     * @return Integer[]
     */
    function shuffle() {
		#region 暴力
/*         $temp = $this->original;
		$length = count($temp);
		$result = [];
		while($length > 0){
			$index = rand(0,$length - 1);
			$result[] = $temp[$index];
			array_splice($temp,$index,1);
			$length--;
		}
		return $result; */
		#endregion
		
		#region 洗牌
		$temp = $this->original;
		$length = count($temp);
		for($i = 0;$i < $length;$i++){
			$random = rand($i,$length - 1);
			if($random != $i)
			$this->swap($temp,$i,$random);
		}
		return $temp;
		#endregion
    }
}

$obj = new Solution([1,2,3]);
print_r($obj->shuffle());
print_r($obj->reset());
print_r($obj->shuffle());