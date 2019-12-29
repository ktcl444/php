<?php
const brackets = [']' => '[', ')' => '(', '}' => '{'];
function check_brackets($str)
{
    $left_brackets = array_values(brackets);
    $right_brackets = array_keys(brackets);
    $str_len = strlen($str);
    $temp = [];
    $brackets = [];
    $has_left_bracket = false;
    for ($i = 0; $i < $str_len; $i++) {
        $char = $str[$i];
        if (in_array($char, $left_brackets)) {
            array_push($temp, array($char, $i));
            $has_left_bracket = true;
        } else if (in_array($char, $right_brackets) && ($temp && brackets[$char] == end($temp)[0])) {
            $brackets[] = array(end($temp)[1] . ' : ' . brackets[$char], "$i : " . $char);
            array_pop($temp);
        }
    }
    $result = empty($temp) && $has_left_bracket;
    $result && print_r($brackets);
    return $result;
}

//$str = '[](({[]}))';
$str = '[]';
echo check_brackets($str) ? 'yes' : 'no';
?>