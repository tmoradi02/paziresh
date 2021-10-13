<?php 
use Hekmatinasser\Verta\Verta;

function jalaliToGergia($value , $spliter='/' , $exitSpliter='-')
{
    $date = explode($spliter , $value); // 1400  03  01 part part data
    $date = Verta::getGregorian($date[0] , $date[1] , $date[2]); // Convert To Milady Date 2021  5  22 

    if(Str::length($date[1]) <2)
    {
        $date[1] = sprintf("%02d",  $date[1]);
    }

    if(Str::length($date[2]) <2)
    {
        $date[2] = sprintf("%02d", $date[2]); 
    }
    
    $date = implode($exitSpliter , $date);  // 2021-5-22  implode Date
    // dd($date);
    return $date;
}


