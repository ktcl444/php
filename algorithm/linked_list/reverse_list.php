<?php

namespace algorithm\linked_list;
require_once 'base\LinkedListAlgorithmBase.php';

class Solution extends \algorithm\linked_list\base\LinkedListAlgorithmBase
{
    //递归
    /* 假设列表为：
    n_{1}->... ->n_{k-1} ->n_{k} ->n_{k+1} ->... ->n_{m} ->null
    若从节点 n_{k+1}到 n_{m}已经被反转，而我们正处于 n_{k}
    n_{1}->... ->n_{k-1} ->n_{k} ->n_{k+1} <- ... <- n_{m}
    我们希望 n_{k+1}  的下一个节点指向 n_{k}
    所以，n_{k}.next.next = n_{k}
    要小心的是 n_{1}的下一个必须指向 null 。如果你忽略了这一点，你的链表中可能会产生循环。如果使用大小为 2 的链表测试代码，则可能会捕获此错误。 */
    function reverseList_1($head)
    {
        if ($head == null || $head->next == null) return $head;
        $node = $this->reverseList_1($head->next);
        $head->next->next = $head;
        $head->next = null;
        return $node;
    }

    //迭代
    /* 	在遍历列表时，将当前节点的 next 指针改为指向前一个元素。由于节点没有引用其上一个节点，因此必须事先存储其前一个元素。在更改引用之前，还需要另一个指针来存储下一个节点。不要忘记在最后返回新的头引用！ */
    function reverseList_2($head)
    {
        $pre = null;
        $cur = $head;
        while ($cur != null) {
            $next = $cur->next;
            $cur->next = $pre;
            $pre = $cur;
            $cur = $next;
        }
        return $pre;
    }

    //迭代
    //链表->栈 出栈->链表
    function reverseList_3($head)
    {
        $stack = [];
        while ($head != null) {
            array_push($stack, $head->val);
            $head = $head->next;
        }
        if (empty($stack))
            return null;
        $root = new \algorithm\linked_list\base\ListNode(array_pop($stack));
        $temp = $root;
        while (!empty($stack)) {
            $temp->next = new \algorithm\linked_list\base\ListNode(array_pop($stack));
            $temp = $temp->next;
        }
        return $root;
    }

    //递归
    //由链表后面的元素构建节点
    function reverseList_4($head)
    {
        $root = new \algorithm\linked_list\base\ListNode(0);
        $this->getNextNode($root, $head);
        return $root;
    }

    function getNextNode(&$root, $head)
    {
        if ($head->next == null) {
            $root->val = $head->val;
            return $root;
        }
        $node = $this->getNextNode($root, $head->next);
        $node->next = new \algorithm\linked_list\base\ListNode($head->val);
        return $node->next;
    }

    function test()
    {
        $head = self::convertArrayToLinkedList([1, 2, 3, 45, 5]);
        print_r($this->reverseList_4($head));
    }
}

(new Solution())->test();