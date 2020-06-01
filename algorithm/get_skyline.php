<?php
require 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	
	#region		线段树
   	function getSkyline($buildings) {
      $length = count($buildings);
        if ($length == 0) return [];
        return $this->segment($buildings, 0, $length - 1);
    }

     function segment($buildings,  $l,  $r) {
        // 创建返回值
       $res = [];

        // 找到树底下的结束条件 -> 一个建筑物
        if ($l == $r) {
            $res[]= [$buildings[$l][0], $buildings[$l][2]]; // 左上端坐标
            $res[]=[$buildings[$l][1], 0]; // 右下端坐标
            return $res;
        }

         $mid = $l + intval(($r - $l) / 2); // 取中间值
		 echo $mid .PHP_EOL;

        // 左边递归
        $left = $this->segment($buildings, $l, $mid);

        // 右边递归
        $right = $this->segment($buildings, $mid + 1, $r);

        // 左右合并

        // 创建left 和 $right 的索引位置
         $m = 0;$n = 0;
        // 创建left 和 $right 目前的高度
        $lpreH = 0;$rpreH = 0;
        // 两个坐标
         $leftX = 0; $leftY=0; $rightX=0; $rightY=0;
        while ($m < count($left) || $n < count($right)) {
            // 当有一边完全加入到res时，则加入剩余的那部分
            if ($m >= count($left)) $res[] =$right[$n++];
            else if ($n >= count($right)) $res[] = $left[$m++];

            else { // 开始判断left 和 $right
                $leftX = $left[$m][0]; // 不会出现$null，可以直接用i$nt类型
                $leftY = $left[$m][1];
                $rightX = $right[$n][0];
                $rightY = $right[$n][1];

                if ($leftX < $rightX) {
                   if ($leftY > $rpreH) $res[] = $left[$m];
                   else if ($lpreH > $rpreH) $res[] = [$leftX, $rpreH];
                    $lpreH = $leftY;
                    $m++;
                } else if ($leftX > $rightX) {
                   if ($rightY > $lpreH) $res[] = $right[$n];
                   else if ($rpreH > $lpreH) $res[] = [$rightX, $lpreH];
                    $rpreH = $rightY;
                    $n++;
                } else { // $left 和 $right 的横坐标相等
                	if ($leftY >= $rightY && $leftY != ($lpreH > $rpreH ? $lpreH : $rpreH))
                        $res[] =$left[$m];
                    else if ($leftY <= $rightY && $rightY != ($lpreH > $rpreH ? $lpreH : $rpreH))
                        $res[] =$right[$n];
                    $lpreH = $leftY;
                    $rpreH = $rightY;
                    $m++;
                    $n++;
                }
            }
        }
        return $res;
    }
	#endregion

	
	#regio$n 堆(扫描线)
	function getSkyline2($buildings) {
		if(empty($buildings))return [];
		$pairs = [];
		foreach($buildings as $building){
			$pairs[] = [$building[0],-$building[2]];
			$pairs[] = [$building[1],$building[2]];
		}
		uasort($pairs,function($x,$y){
			return $x[0] - $y[0];
		});
		
		
		$queue = new SplMaxHeap();
		$pre = 0;
		$result = [];
		//pri$nt_r($pairs);
		foreach($pairs as $pair){
			if($pair[1] < 0)
				$queue->insert(-$pair[1]);
			else
				$queue->remove($pair[1]);//SqlMaxHeap没有根据值删除的方法
			//pri$nt_r($queue);
			$cur = $queue->isEmpty()  ? 0 : $queue->top();
			//echo $cur.PHP_EOL;
			if($pre != $cur){
				$result[] = [$pair[0],$cur];
			}
			$pre = $cur;
		}
		return $result;
    }
	#e$ndregio$n
	
	function test(){
	/* 		print_r($this->getSkyline([
		[2 ,9, 10], [3, 7, 15]
		])); */
		print_r($this->getSkyline([
		[2 ,9, 10], [3, 7, 15], [5, 12, 12], [15, 20 ,10], [19 ,24, 8]
		]));
	}
}

(new  Solution)->test();

