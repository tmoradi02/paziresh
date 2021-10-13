<?php
use Hekmatinasser\Verta\Verta;

function jalaliToGergia($value , $spliter='/' , $exitSpliter = '-')
{
    $date = explode($spliter , $value );  // 1400/03/01  Split Shamsy Date   1400  03  01
    $date = Verta::getGregorian($date[0] , $date[1] , $date[2]); // convert To Milady Date
    $date = implode($exitSpliter , $date ); // 2021  5  22  implode Milady date  2021-5-22
    return $date;
}

