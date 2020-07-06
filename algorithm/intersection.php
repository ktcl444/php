<?php

require_once 'base\AlgorithmBase.php';

//交点-数学
class Solution extends \algorithm\base\AlgorithmBase
{
    function intersection($start1, $end1, $start2, $end2) {
		$x1 = $start1[0];
		$y1 = $start1[1];
		$x2 = $end1[0];
		$y2 = $end1[1];
		$x3 = $start2[0];
		$y3 = $start2[1];
		$x4 = $end2[0];
		$y4 = $end2[1];
		
		$ans = [];
		// 判断 (x1, y1)~(x2, y2) 和 (x3, y3)~(x4, y3) 是否平行
        if (($y4 - $y3) * ($x2 - $x1) == ($y2 - $y1) * ($x4 - $x3)) {
            // 若平行，则判断 (x3, y3) 是否在「直线」(x1, y1)~(x2, y2) 上
            if (($y2 - $y1) * ($x3 - $x1) == ($y3 - $y1) * ($x2 - $x1)) {
                // 判断 (x3, y3) 是否在「线段」(x1, y1)~(x2, y2) 上
                if ($this->inside($x1, $y1, $x2, $y2, $x3, $y3)) {
                    $this->update($ans, floatval($x3), floatval($y3));
                }
                // 判断 (x4, y4) 是否在「线段」(x1, y1)~(x2, y2) 上
                if ($this->inside($x1, $y1, $x2, $y2, $x4, $y4)) {
                    $this->update($ans, floatval($x4), floatval($y4));
                }
                // 判断 (x1, y1) 是否在「线段」(x3, y3)~(x4, y4) 上
                if ($this->inside($x3, $y3, $x4, $y4, $x1, $y1)) {
                    $this->update($ans, floatval($x1), floatval($y1));
                }
                // 判断 (x2, y2) 是否在「线段」(x3, y3)~(x4, y4) 上
                if ($this->inside($x3, $y3, $x4, $y4, $x2, $y2)) {
                    $this->update($ans,floatval($x2), floatval($y2));
                }
            }
            // 在平行时，其余的所有情况都不会有交点
        }
        else {
            // 联立方程得到 t1 和 t2 的值
            $t1 = (double)($x3 * ($y4 - $y3) + $y1 * ($x4 - $x3) - $y3 * ($x4 - $x3) - $x1 * ($y4 - $y3)) / (($x2 - $x1) * ($y4 - $y3) - ($x4 - $x3) * ($y2 - $y1));
            $t2 = (double)($x1 * ($y2 - $y1) + $y3 * ($x2 - $x1) - $y1 * ($x2 - $x1) - $x3 * ($y2 - $y1)) / (($x4 - $x3) * ($y2 - $y1) - ($x2 - $x1) * ($y4 - $y3));
            // 判断 t1 和 t2 是否均在 [0, 1] 之间
            if ($t1 >= 0.0 && $t1 <= 1.0 && $t2 >= 0.0 && $t2 <= 1.0) {
                $ans = [$x1 + $t1 * ($x2 - $x1), $y1 + $t1 * ($y2 - $y1)];
            }
        }
        return $ans;
    }
	// 判断 (xk, yk) 是否在「线段」(x1, y1)~(x2, y2) 上
	function inside($x1,$y1,$x2,$y2,$xk,$yk){
		// 若与 x 轴平行，只需要判断 x 的部分
        // 若与 y 轴平行，只需要判断 y 的部分
        // 若为普通线段，则都要判断
		return 
		($x1 == $x2 || (min($x1,$x2) <= $xk && $xk <= max($x1,$x2))) 
		&&
		($y1 == $y2 || (min($y1,$y2) <= $yk && $yk <= max($y1,$y2)));
	}
	
	function update(&$ans,$xk,$yk){
		if(empty($ans) || $xk < $ans[0] || ($xk == $ans[0] && $yk < $ans[1]))
			$ans = [$xk,$yk];
	}
	
	
	function test(){
		print_r($this->intersection(
		[0,3],
		[0,6],
		[0,1],
		[0,5]));
	}
}

(new Solution())->test();