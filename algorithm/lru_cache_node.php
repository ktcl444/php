<?php

class Node
{
    public $key;
    public $val;
    public $prev;
    public $next;

    public function __construct($key, $val) 
    {
        $this->key = $key;
        $this->val = $val;
    }
}

class LRUCache 
{
    private $cap;
    private $dict = [];
    public $head;
    private $tail;

    /**
     * @param Integer $capacity
     */
    public function __construct($capacity)
    {
        $this->cap = $capacity;

        $this->head = new Node(-1, -1);
        $this->tail = new Node(-1, -1);
        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
    }

    /**
     * @param Node $node
     */
    private function addNodeToHead($node)
    {
        $node->next = $this->head->next;
        $node->prev = $this->head;

        $node->next->prev = $node;
        $node->prev->next = $node;
    }

    /**
     * @param Node $node
     */
    private function removeNode($node)
    {
        $node->prev->next = $node->next;
        $node->next->prev = $node->prev;
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    public function get($key)
    {
        if (!isset($this->dict[$key])) {
            return -1;
        }
        
        $node = $this->dict[$key];
        
        // 将被访问的节点调整到链表头部
        $this->removeNode($node);
        $this->addNodeToHead($node);

        return $node->val;
    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    public function put($key, $value)
    {
        if (isset($this->dict[$key])) {
            $oldValue = $this->get($key);
            if ($value !== $oldValue) {
                $this->dict[$key]->val = $value;
            }
        } else {
            $node = new Node($key, $value);
            $this->dict[$key] = $node;
            $this->addNodeToHead($node);
            $this->cap--;

            if ($this->cap < 0) {
                $lastNode = $this->tail->prev;
                $this->removeNode($lastNode);
                unset($this->dict[$lastNode->key]);
                $this->cap++;
            }
        }
    }
}

/**
 * Your LRUCache object will be instantiated and called as such:
 * $obj = LRUCache($capacity);
 * $ret_1 = $obj->get($key);
 * $obj->put($key, $value);
 */


 $cache = new LRUCache(2);
/* $cache->put(1,1);
$cache->put(2,2);
echo $cache->get(1).PHP_EOL;
 $cache->put(3,3);
 echo $cache->get(2).PHP_EOL;
$cache->put(4,4);
echo $cache->get(1).PHP_EOL;
echo $cache->get(3).PHP_EOL;
echo $cache->get(4).PHP_EOL;   */
$cache->put(2,1);
$cache->put(1,1);
//print_r($cache->head);
$cache->put(2,3);
echo $cache->get(2).PHP_EOL;
//print_r($cache->head);
$cache->put(4,1);
//print_r($cache->head);
echo $cache->get(1).PHP_EOL;
echo $cache->get(2).PHP_EOL;

