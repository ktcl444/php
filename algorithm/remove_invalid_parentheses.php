<?php

require_once 'base\AlgorithmBase.php';

//删除无效的括号-bfs
class Solution extends \algorithm\base\AlgorithmBase
{
	
	function removeInvalidParentheses($s) {
        $level = [$s];
		while(!empty($level)){
			$min_un_valid_count = PHP_INT_MAX;
			$result = [];
			$list = [];
			
			foreach($level as $s)
			{
				$un_valid_count = $this->is_valid($s);

				if($un_valid_count == 0)
				{
					$min_un_valid_count = 0;
					!in_array($s,$result) && $result[] = $s;
				}else
				{
					if($un_valid_count <= $min_un_valid_count)
					{
						$list[] = $s;
						if($un_valid_count < $min_un_valid_count)
						{
							$result = [];
						}
						$min_un_valid_count = $un_valid_count;
					}
				}
				//echo 's:'.$s.' c:'.$un_valid_count;
			} 
			
			if(!empty($result)) return $result;
			
			$next_level = [];
			foreach($list as $s)
			{
				for($i = 0;$i<strlen($s);$i++)
				{
					$c = substr($s,$i,1);
					if($c == '(' || $c == ')')
					{
						$temp = substr($s,0,$i).substr($s,$i+1);
						//echo 'c:'.$c.' t:'.$temp.PHP_EOL;
						(!empty($temp) && !in_array($temp,$next_level)) && $next_level[] = $temp;
						//print_r($next_level);
					}
				}
			}
			$level = $next_level;
		}
		
		return [];
    }
	
	function is_valid($s)
	{
		$array = str_split($s);
		//print_r($array);
		$un_valid_count = 0;
		$count = 0;
		foreach($array as $c)
		{
			if($c == '(')
				$count++;
			if($c == ')')
				$count --;
			if($count < 0)
			{
				$un_valid_count += -$count;
				$count = 0;
			}
		}
		return $count + $un_valid_count;
	}
	
	function  test()
	{
		print_r($this->removeInvalidParentheses(')('));
		print_r($this->removeInvalidParentheses('()())()'));
		print_r($this->removeInvalidParentheses('(a)())()'));
		print_r($this->removeInvalidParentheses('(()'));
	}
}

(new Solution())->test();