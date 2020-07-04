<?php

#region 链表hash
class LFUCache{
	private $size;
	private $cap;
	private $double_node_list;
	private $min;
	private $cache;
	function __construct($capacity) {
        $this->cap = $capacity;
		$this->size = 0;
		$this->min = 0;
		$this->double_node_list = [];
		$this->cache = [];
	}
	
	 function get($key) {
		 if(array_key_exists($key,$this->cache)){
			 $node = $this->cache[$key];
			 $this->updateNode($node);
			 return $node->getData();
		 }
		 
		 return -1;
	 }
	 
	 function put($key,$value){
		 if($this->cap <= 0)return;
		 if(array_key_exists($key,$this->cache)){
			 $node = $this->cache[$key];
			 $node->setData($value);
			 $this->updateNode($node);
		 }else{
			 $this->clearNode();
			 $node = new Node($key,$value,1);
			 $this->cache[$key] = $node;
			 if(!array_key_exists(1,$this->double_node_list)){
				 $this->double_node_list[1] = new DoubleNode();
			 }
			 $this->double_node_list[1]->add($node);
			 $this->size++;
			 $this->min = 1;
		 }
	 }
	 
	 function clearNode(){
		 if($this->size == $this->cap){
			 $node_list = $this->double_node_list[$this->min];
			 $remove_node = $node_list->tail->getPrevious();
			 $remove_key = $remove_node->getKey();
			 unset($this->cache[$remove_key]);
			 $node_list->remove($remove_node);
			 $this->size--;
		 }
	 }
	 
	 function updateNode($node){
		 $count = $node->getCount();
		 $node_list = $this->double_node_list[$count];
		 $node_list->remove($node);
		 
		 if($this->min == $count && $node_list->head->getNext() == $node_list->tail){
			 $this->min++;
		 }
		 $node->setCount($count+1);
		 if(!array_key_exists($count + 1,$this->double_node_list)){
			 $this->double_node_list[$count+1] = new DoubleNode();
		 }
		 $this->double_node_list[$count+1]->add($node);
	 }
}

class DoubleNode{
	public $head;
	public $tail;
	function __construct(){
		$this->head = new Node(null,null);
		$this->tail = new Node(null,null);
		$this->head->setNext($this->tail);
		$this->tail->setPrevious($this->head);
	}
	
	function remove($node){
		$node->getPrevious()->setNext($node->getNext());
		$node->getNext()->setPrevious($node->getPrevious());
	}
	
	function add($node){
		$this->head->getNext()->setPrevious($node);
		
		$node->setNext($this->head->getNext());
		$node->setPrevious($this->head);
		
		$this->head->setNext($node);
	}
}
#endregion

#region 链表
class LFUCache1{
	private $cap;
	private $hashmap;
	private $head;
	private $tail;
	private $double_node;
    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->cap = $capacity;
		$this->hashmap = [];
		$this->head = new Node(null,null);
		$this->tail = new Node(null,null);
		$this->head->setNext($this->tail);
		$this->tail->setPrevious($this->head);
    }
  
    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
		if(!array_key_exists($key,$this->hashmap)){
			return -1;
		}
		
		$node = $this->hashmap[$key];
		$node->setCount($node->getCount()+1);
		$this->detch($node);
		$this->attach($this->getHead($node),$node);
		return $node->getData();
    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
		if($this->cap <= 0) return -1;
		
		if(count($this->hashmap) == $this->cap && !array_key_exists($key,$this->hashmap)){
			$this->removeTail();
		}
		
		if(!array_key_exists($key,$this->hashmap)){
			$node = new Node($key,$value,1);
			$this->attach($this->getHead($node),$node);
			$this->hashmap[$key] = $node;
		}else{
			$node = $this->hashmap[$key];
			$node->setData($value);
			$node->setCount($node->getCount()+1);
			$this->detch($node);
			$this->attach($this->getHead($node),$node);
		}
    }
	
	private function getHead($node){
		$head = $node->getPrevious() ?? $this->tail->getPrevious();
		while($head->getCount() != 0 && $head->getCount() <= $node->getCount()){
			$head = $head->getPrevious();
		}
		
		return $head;
	}
	
	private function removeTail(){
		$remove_node = $this->tail->getPrevious();
		$this->detch($remove_node);
		unset($this->hashmap[$remove_node->getKey()]);
	}
	
	private function attach($head,$node){
		$node->setPrevious($head);
		$node->setNext($head->getNext());
		$node->getPrevious()->setNext($node);
		$node->getNext()->setPrevious($node);
	}
	
	private function detch($node){
		$node->getPrevious()->setNext($node->getNext());
		$node->getNext()->setPrevious($node->getPrevious());
	}
	
	function print_v(){
		//if($key == 3){
			//print_r($this->hashmap);
			print_r($this->head);
	//	}
	}
}

class Node{
	private $_key ;
	private $_data;
	private $_count = 0;
	private $_pre;
	private $_next;
	function __construct($key,$data,$count = 0){
		$this->_data = $data;
		$this->_key = $key;
		$this->_count = $count;
	}
	
	function setData($data){
		$this->_data = $data;
	}
	
	function setCount($count){
		$this->_count = $count;
	}
	
	function getCount(){
		return $this->_count;
	}
	
	function getData(){
		return $this->_data;
	}
	
	function getKey(){
		return $this->_key;
	}
	
	function setPrevious($node){
		$this->_pre = $node;
	}
	
	function setNext($node){
		$this->_next = $node;
	}
	
	function getPrevious(){
		return $this->_pre;
	}
	
	function getNext(){
		return $this->_next;
	}
}
#endregion
$cache = new LFUCache(2  );/* capacity (缓存容量) */

 $cache->put(1, 1);
$cache->put(2, 2);
echo $cache->get(1).PHP_EOL;         
$cache->put(3, 3);    
//$cache->print_v();
echo $cache->get(2).PHP_EOL;       
echo $cache->get(3).PHP_EOL; 

//$cache->print_v();
$cache->put(4, 4);   

//$cache->print_v(); 
echo $cache->get(1).PHP_EOL;       
echo $cache->get(3).PHP_EOL;        
echo $cache->get(4).PHP_EOL;   

/* $order = ["put","put","put","put","put","get","put","get","get","put","get","put","put","put","get","put","get","get","get","get","put","put","get","get","get","put","put","get","put","get","put","get","get","get","put","put","put","get","put","get","get","put","put","get","put","put","put","put","get","put","put","get","put","put","get","put","put","put","put","put","get","put","put","get","put","get","get","get","put","get","get","put","put","put","put","get","put","put","put","put","get","get","get","put","put","put","get","put","put","put","get","put","put","put","get","get","get","put","put","put","put","get","put","put","put","put","put","put","put"];
$params = [[10,13],[3,17],[6,11],[10,5],[9,10],[13],[2,19],[2],[3],[5,25],[8],[9,22],[5,5],[1,30],[11],[9,12],[7],[5],[8],[9],[4,30],[9,3],[9],[10],[10],[6,14],[3,1],[3],[10,11],[8],[2,14],[1],[5],[4],[11,4],[12,24],[5,18],[13],[7,23],[8],[12],[3,27],[2,12],[5],[2,9],[13,4],[8,18],[1,7],[6],[9,29],[8,21],[5],[6,30],[1,12],[10],[4,15],[7,22],[11,26],[8,17],[9,29],[5],[3,4],[11,30],[12],[4,29],[3],[9],[6],[3,4],[1],[10],[3,29],[10,28],[1,20],[11,13],[3],[3,12],[3,8],[10,9],[3,26],[8],[7],[5],[13,17],[2,27],[11,15],[12],[9,19],[2,15],[3,16],[1],[12,17],[9,1],[6,19],[4],[5],[5],[8,1],[11,7],[5,2],[9,28],[1],[2,2],[7,4],[4,22],[7,24],[9,26],[13,28],[11,26]];

foreach($order as $key => $o ){
	if($o == 'put'){
		$cache->put($params[$key][0], $params[$key][1]);   
	}else{
		echo $cache->get($params[$key][0]).PHP_EOL; 
	}
} */



 
