<?php
function goto_for($n)
{
    $i = 1;
    $sum = 0;
//    for($i = 1;$i<=$n;$i++)
//    {
//        $sum += $i;
//    }
    Loop_Start:
    {
        if ($i > $n) {
            goto Loop_end;
        }
        $sum += $i;
        goto Loop;
    }
    Loop:
    {
        $i++;
        goto Loop_Start;
    }
    Loop_end:
    {

    }

    echo $sum;
}

goto_for(10);