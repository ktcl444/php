<?php

require_once 'base\AlgorithmBase.php';

//最长有效括号
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 动态规划(自下向上)
	function isMatch1($s,$p){
		$lens = strlen($s);
        $lenp = strlen($p);
		
		$dp[$lens][$lenp] = true;
		for($i = $lens;$i>=0;$i--)
		{
			for($j =$lenp-1;$j>=0;$j--)
			{
				$first_match = (($i < $lens) && ($p[$j] == $s[$i] || $p[$j] == '.'));
				if($j + 1 < $lenp && $p[$j+1] == '*')
				{
					$dp[$i][$j] = ($dp[$i][$j+2] || ($first_match && $dp[$i+1][$j]));
				}else
				{
					$dp[$i][$j] = ($first_match && $dp[$i+1][$j+1]);
				}
			}
		}
		
		return !!$dp[0][0];
	}
	#endregion`
	
	#region 动态规划(自顶向下)
	private $memo = [];
	function isMatch($s,$p){
		//$this->memo = array_fill(0,strlen($s)+1,array_fill(0,strlen($p)+1,-1));
		return $this->helper(0,0,$s,$p);
	}
	
	function  helper($i,$j,$s,$p){
 		if(isset($this->memo[$i][$j]))
		{
			return $this->memo[$i][$j] == true; 
		}
		
		$lens = strlen($s);
        $lenp = strlen($p);
		$result = false;
		if($j == $lenp)
			$result = $i == $lens;
		else{
			$first_match = $i < $lens && ($p[$j] == $s[$i] || $p[$j] == '.');
			if($j + 1 < $lenp && $p[$j+1] == '*')
			{
				$result = $this->helper($i,$j+2,$s,$p) || ($first_match && $this->helper($i+1,$j,$s,$p));
			}else{
				$result = $first_match && $this->helper($i+1,$j+1,$s,$p);
			}
		}
		
		$this->memo[$i][$j] = $result;
		return $result;
		
	}
	
	function init(){
		$this->memo = [];
	}
	#endregion
	
	#region 回溯
	function isMatch2($s,$p){
		if(empty($p)) return empty($s);
		$first_match = !empty($s) && ($s[0] == $p[0] || $p[0] == '.');
		
		if(strlen($p) >= 2 && $p[1] == '*'){
			return $this->isMatch($s,substr($p,2)) || ($first_match && $this->isMatch(substr($s,1),$p));
		}else{
			return $first_match && $this->isMatch(substr($s,1),substr($p,1));
		}
	}
	#endregion
    function isMatch2($s, $p) {
		if(empty($p)) return empty($s);
		$first_match = !empty($s) && ($s[0] == $p[0] || $p[0] == '.');
		
		if(strlen($p) >= 2 && $p[1] == '*'){
			return $this->isMatch($s,substr($p,2)) || ($first_match && $this->isMatch(substr($s,1),$p));
		}else{
			return $first_match && $this->isMatch(substr($s,1),substr($p,1));
		}
    }
	#endregion
	
	function test(){
		echo $this->isMatch('aa','a').PHP_EOL;
		$this->init();
		echo $this->isMatch('aa','a*').PHP_EOL;
		$this->init();
		echo $this->isMatch('ab','.*').PHP_EOL;
		$this->init();
		echo $this->isMatch('aab','c*a*b').PHP_EOL;
		$this->init();
		echo $this->isMatch('mississippi','mis*is*p*.').PHP_EOL;
	}
}

(new Solution())->test();