<?php


namespace algorithm\linked_list\base;

use \algorithm\linked_list\base\ListNode as ListNode;

require("ListHelper.php");
require_once __DIR__ . '\..\..\base\AlgorithmBase.php';

abstract class LinkedListAlgorithmBase extends \algorithm\base\AlgorithmBase
{
    public static function convertArrayToLinkedList($array, $end_index = -1)
    {
        return ListHelper::convertArrayToLinkedList($array, $end_index);
    }

    public static function connectTwoList(ListNode $a, ListNode $b)
    {
        while ($a->next != null) {
            $a = $a->next;
        }
        $a->next = $b;
        return $a;
    }
}