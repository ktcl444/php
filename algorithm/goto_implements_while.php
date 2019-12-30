<?php
function goto_while($n)
{
    $i = 1;
    $num = 0;
//    while ($i <= $n) {
//        $num += $i;
//        $i++;
//    }
    Loop:
    {
        if ($i > $n) {
            goto Loop_end;
        }
        $num += $i;
        $i++;
        goto  Loop;
    }
    Loop_end:

    echo $num;
}

goto_while(10);