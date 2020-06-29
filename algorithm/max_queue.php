<?php
//队列的最大值-队列&最大值数组
class MaxQueue {
    private $queue;
    private $max = [];
    /**
     */
    function __construct() {
        $this->queue = new SplQueue();
        $this->max = [];
    }

    /**
     * @return Integer
     */
    function max_value() {
        return $this->queue->isEmpty() ? -1 : reset($this->max);
    }

    /**
     * @param Integer $value
     * @return NULL
     */
    function push_back($value) {
        $this->queue->enqueue($value);
        while(!empty($this->max) && end($this->max) < $value){
            array_pop($this->max);
        }
        array_push($this->max,$value);
    }

    /**
     * @return Integer
     */
    function pop_front() {
        if($this->queue->isEmpty())
            return -1;
        $res = $this->queue->dequeue();
        if($res == reset($this->max)){
            array_shift($this->max);
        }
        return $res;
    }
}

  $obj = new MaxQueue();
  $obj->push_back(2);
  $obj->push_back(2);
  echo $obj->max_value().PHP_EOL;
  echo $obj->pop_front().PHP_EOL;
  echo $obj->max_value().PHP_EOL;
