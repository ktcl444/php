<?php
function goto_do_while($n)
{
    $i = 1;
    $num = 0;
//    do {
//        $num  += $i;
//        $i++;
//    } while ($i <= $n);
    Loop:
    {
        $num += $i;
        $i++;
        if ($i > $n) {
            goto Loop_end;
        }
        goto  Loop;
    }
    Loop_end:

    echo $num;
}

goto_do_while(10);