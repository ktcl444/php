<?php
//数据流的 中位数-最大堆和最小堆
class MedianFinder {
	private $min;
	private $max;
    /**
     * initialize your data structure here.
     */
    function __construct() {
        $this->min = new SplMinHeap();
		$this->max = new SplMaxHeap();
    }
  
    /**
     * @param Integer $num
     * @return NULL
     */
    function addNum($num) {
       $this->max->insert($num);
	   $this->min->insert($this->max->extract());
	   if($this->max->count() <$this->min->count())
			$this->max->insert($this->min->extract());
    }
  
    /**
     * @return Float
     */
    function findMedian() {
		if($this->max->count() > $this->min->count())
			return $this->max->top();
		return ($this->max->top() + $this->min->top()) / 2;
		#region 简单排序
/* 		if(empty($this->stack))return 0;
        $length = count($this->stack);
		if($length % 2 == 0){
			$center = $length /2;
			return ($this->stack[$center] + $this->stack[$center - 1]) / 2;
		}else{
			$center = $length / 2;
			return $this->stack[$center];
		} */
		#endregion
    }
}

$obj = new MedianFinder();
$obj->addNum(1);
$obj->addNum(2);
echo $obj->findMedian().PHP_EOL;