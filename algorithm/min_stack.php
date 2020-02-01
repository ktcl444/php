<?php
require_once __DIR__ . '\base\AlgorithmBase.php';
require_once __DIR__ . '\linked_list\base\ListNode.php';

use \algorithm\linked_list\base\ListNode as ListNode;

class min_stack
{
    /**
     * @var ListNode
     */
    private $sort_list_node = null;

    private $min_stack = [];
    private $stack = [];

    /**
     * initialize your data structure here->
     */
    function __construct()
    {

    }

    function push($x)
    {
        array_push($this->stack, $x);
        if (empty($this->min_stack) || end($this->min_stack) >= $x) {
            array_push($this->min_stack, $x);
        }
//        $this->push_sort_array($x);
    }

    function pop()
    {
        $x = array_pop($this->stack);
        if (!empty($this->min_stack) && end($this->min_stack) == $x) {
            array_pop($this->min_stack);
        }
//        $this->pop_sort_array($x);
    }

    /**
     * @return Integer
     */
    function top()
    {
        return end($this->stack);
    }

    /**
     * @return Integer
     */
    function getMin()
    {
        return empty($this->min_stack) ? null : end($this->min_stack);
//        return $this->sort_list_node->val;
    }

    #region 辅助链表
    private function push_sort_array($x)
    {
        if ($this->sort_list_node == null) {
            $this->sort_list_node = new ListNode($x);
        } else {
            $head = $this->sort_list_node;
            while ($head != null) {
                if ($head->val >= $x) {
                    $temp = new ListNode($head->val);
                    $temp->next = $head->next;
                    $head->val = $x;
                    $head->next = $temp;
                    break;
                } else {
                    if ($head->next == null) {
                        $head->next = new ListNode($x);
                        $head = $head->next->next;
                    } else {
                        $head = $head->next;
                    }
                }
            }
        }
    }

    private function pop_sort_array($x)
    {
        if ($this->sort_list_node->val == $x) {
            $this->sort_list_node = $this->sort_list_node->next;
        }
        $head = $this->sort_list_node;
        while ($head->next != null) {
            if ($head->next->val == $x) {
                $head->next = $head->next->next;
                break;
            }
            $head = $head->next;
        }
    }
    #endregion
}

class Solution extends \algorithm\base\AlgorithmBase
{
    function test()
    {
        $minStack = new min_stack();
        $minStack->push(-2);
        $minStack->push(0);
        $minStack->push(-3);
        echo $minStack->getMin() . PHP_EOL;
        $minStack->pop();;
        echo $minStack->top() . PHP_EOL;;
        echo $minStack->getMin() . PHP_EOL;;
    }
}

(new Solution())->test();