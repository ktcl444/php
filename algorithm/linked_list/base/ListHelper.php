<?php

namespace algorithm\linked_list\base;
require("ListNode.php");

class ListHelper
{
    public static function convertArrayToLinkedList($array)
    {
        return empty($array) ? null : self::getListNode($array, count($array), 0);
    }

    private static function getListNode($array, $length, $index)
    {
        if ($index == $length - 1) {
            return new ListNode($array[$index]);
        }

        $node = new ListNode($array[$index]);
        $node->next = self::getListNode($array, $length, $index + 1);
        return $node;
    }
}

//print_r(ListHelper::convertArrayToLinkedList([1,3,4,5,6]));