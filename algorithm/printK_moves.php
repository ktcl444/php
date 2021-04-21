<?php

require_once 'base\AlgorithmBase.php';
// 兰顿蚂蚁-双向链表
class Solution extends \algorithm\base\AlgorithmBase
{   
    function printKMoves($K) {
        $cur_dir = $this->getStartDir();
		//print_r($cur_dir);
        $cur_p = [0,0];
        $min_x = $max_x = $min_y = $max_y = 0;
        $colors[0][0] = '_';
        for($i = 0;$i < $K;$i++){
            $cur_x = $cur_p[0];
            $cur_y = $cur_p[1];
            if($colors[$cur_x][$cur_y]!='X'){
                $colors[$cur_x][$cur_y] = 'X';
                $offset = $this->getOffset($cur_dir->desc);
                $cur_dir = $cur_dir->next;
            }else{
                $colors[$cur_x][$cur_y] = '_';
                $offset = $this->getOffset($cur_dir->desc,false);
                $cur_dir = $cur_dir->pre;
            }
            $cur_p = [$cur_x+$offset[0],$cur_y+$offset[1]];
            $min_x = min($min_x,$cur_p[0]);
            $max_x = max($max_x,$cur_p[0]);
            $min_y = min($min_y,$cur_p[1]);
            $max_y = max($max_y,$cur_p[1]);
        } 
        $colors[$cur_p[0]][$cur_p[1]] = $cur_dir->desc;
        $ans = [];
        for($i = $min_x;$i<= $max_x;$i++){
            $list = '';
            for($j = $min_y;$j <= $max_y;$j++){
                $list .= $colors[$i][$j] ?? '_';
            }
            $ans[] = $list;
        }
        return $ans;
    }

    function getOffset($cur_desc,$right = true){
        switch($cur_desc){
            case 'R':
                return $right ? [1,0]:[-1,0];
            case 'D';
                return $right ? [0,-1] : [0,1];
            case 'L':
                return $right ? [-1,0] : [1,0];
            case 'U':
                return $right ? [0,1] : [0,-1];
        }
    }

    function getStartDir(){
        $right = new Direction('R');
        $down = new Direction('D');
        $left = new Direction('L');
        $up = new Direction('U');
		$right->next = $down;
		$down->next = $left;
		$left->next = $up;
		$up->next = $right;
		$up->pre = $left;
		$left->pre = $down;
		$down->pre = $right;
		$right->pre = $up;
        return $right;
    }

	function test(){
		//print_r( $this->printKMoves(1));
		print_r( $this->printKMoves(5));
	}
}

class Direction{
    public $pre;
    public $next;
    public $desc;
    public function __construct($dir){
        $this->desc = $dir;
    }
}

(new Solution())->test();