<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	//水能达到的最高位置，等于两边最大高度的较小值减去当前高度的值
	
	#region 暴力
	function trap1($height) {
		$max_left_mapping = [];
		$max_right_mapping = [];
		$length = count($height);
		$max_left_mapping[0] = $height[0];
		$max_right_mapping[$length - 1] = $height[$length - 1];
		
		for($i = 1; $i < $length - 1; $i++)
		{
			$max_left_mapping[$i] = max($height[$i],$max_left_mapping[$i - 1]);
		}
		for($i = $length - 2;$i > 0;$i --)
		{
			$max_right_mapping[$i] = max($height[$i],$max_right_mapping[$i + 1]);
		}
		$result = 0;
		for($i = 1; $i < $length - 1; $i++){
			$result += (min($max_left_mapping[$i],$max_right_mapping[$i]) - $height[$i]);
		}
		
		return $result;
	}
	#endregion
	
	#region 栈
	function trap($height) {
		$stack = [];
		$cur = 0;
		$length = count($height);
		$result = 0;
		while($cur < $length)
		{
			while(!empty($stack) && $height[$cur] > $height[end($stack)])
			{
				$top = array_pop($stack);
				if(empty($stack))
					break;
				$distance = $cur - end($stack)  -1;
				$t_height = min($height[$cur],$height[end($stack)]) - $height[$top];
				$result += $distance * $t_height;
			}
			array_push($stack,$cur++);
		}
		
		return $result;
	}
	#endregion
	
	#region 一维转二维
	private $height = [];
	private $black = [];
	private $white = [];
	private $length = 0;
	function trap2($height) {
		$this->height = $height;
        $this->length = count($height);
        $max = max($height);
        $this->black = array_fill(0,$this->length,array_fill(0,$max,0));

        for($i = 0;$i < $this->length;$i++)
        {
            $post= $height[$i];
            if($post > 0)
            {
                //cur
				$this->init_black($i,$post);	
				//pre
                $this->init_pre($i,$post);
                //next
				$this->init_next($i,$post);
            }
        }
		//print_r($this->white);
		return $this->check_white();
    }
	
	function init_black($i,$post)
	{
		 while($post > 0){
            $this->black[$i][$post-1] = 1;
            $post--;
        }
	}
	
	function init_pre($i,$post)
	{
		$pre = $i - 1;
		while($pre >= 0){
			if(!array_key_exists($pre,$this->white))
			{
				$pre_post = $this->height[$pre];
				
				$temp = $post;
				while($pre_post < $temp)
				{
					$this->white[$pre][$temp-1] = 1;
					$temp--;
				}
			}else{
				break;
			}
			$pre--;
		}
	}
	
	function init_next($i,$post)
	{
		$next = $i + 1;
		while($next < $this->length){
			if(!array_key_exists($next,$this->white))
			{
				$next_post = $this->height[$next];
				if($next_post >= $post)
				{
					break;
				}
				$temp = $post;
				while($next_post < $temp)
				{
					$this->white[$next][$temp-1] = 1;
					$temp--;
				}
			}else
			{
				break;
			}
			$next ++;
		}
	}
	
	function check_white()
	{
		$result = 0;
		$first = 0;
		$end = $this->length - 1;
		if(array_key_exists($first,$this->white))
		{
			foreach($this->white[$first] as $y => $value){
				$this->white[$first][$y] = 0;
				$this->check_next($first,$y);
			}
		}
		if(array_key_exists($end,$this->white))
		{
			foreach($this->white[$end] as $y => $value){
				$this->white[$end][$y] = 0;
				$this->check_pre($end,$y);
			}
		}
		ksort($this->white);
 		foreach($this->white as $x => $y_list)
		{
			foreach($y_list as $y => $value)
			{
				if($x != 0 && $x != $this->length - 1)
				{
					$pre_x = $x - 1;
					$next_x = $x + 1;
					if(!$this->black[$next_x][$y] && !$this->white[$next_x][$y])
					{
						$this->white[$x][$y] = 0;
						$this->check_pre($x,$y);
					}
					else if( !$this->black[$pre_x][$y] && !$this->white[$pre_x][$y] )
					{
						$this->white[$x][$y] = 0;
						$this->check_next($x,$y);
					}
				}
				if($this->white[$x][$y] == 1 )
				{
					//echo $x.' ' .$y.PHP_EOL;
				}
				$this->white[$x][$y] == 1 && $result++;
			}
		} 
		
		return $result;
	}
	
	function check_pre($pre_x,$y)
	{
		while(--$pre_x >= 0){
		if(!is_null($this->white[$pre_x][$y]) && $this->white[$pre_x][$y] == 1)
			{
					$this->white[$pre_x][$y] = 0;
			}else
			{
				break;
			}
		}
	}
	
	function check_next($next_x,$y)
	{
		while(++$next_x<$this->length){
		if(!is_null($this->white[$next_x][$y]) && $this->white[$next_x][$y] == 1)
			{
				$this->white[$next_x][$y] = 0;
			}else{
				break;
			}
		}
	}
	#endregion

	function test(){
 		echo $this->trap([0,1,0,2,1,0,1,3,2,1,2,1]).PHP_EOL;
		$this->white = [];
		
		echo $this->trap([0,5,6,4,6,1,0,0,2,7]).PHP_EOL;
		$this->white = []; 
		
		echo $this->trap([0,3,4,4,6,6]).PHP_EOL;
		$this->white = [];
	}
}



(new Solution())->test();