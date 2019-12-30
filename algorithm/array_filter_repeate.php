<?php
function filter_repeated(array $array)
{
    foreach ($array as $value) {
        $arr[$value] = $value;
    }

    return $arr;
}

print_r(filter_repeated(array(1, 1, 3, 2, 2, 3, 1, 1)));