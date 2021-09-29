<?php 
namespace App\Options;
use Hekmatinasser\Verta\Verta;

use Illuminate\Support\Facades\Schema;
use App\ArmAgahi;
// use Illuminate\Support\Facades\Input;

trait ChangeDateOptions{

    public function getFromDateAttribute($value)
    {
        $date = explode('-' , $value);
        $date = Verta::getJalali($date[0],$date[1],$date[2]);
        $date = implode('/' , $date);
        
        return $date;
    }

    public function setFromDateAttribute($value)
    {
        // زمان ساختن دیبی سید به دلیل خالی بودن و نداشتن اطلاعات ارور میده
        // if ( ArmAgahi::where('from_date', '=', Input::get('from_date'))->exists()) 
        // {


            // if ($arm_agahi = ArmAgahi::where('id', '=', Input::get('id'))->count() > 0) 
        // {

            // $arm_agahi = ArmAgahi::all();
            // if($arm_agahi->isEmpty()){
            //     // has no records

        $date = explode('/' , $value); // 1400  03   01  Part Part mikone  
        $date = Verta::getGregorian($date[0],$date[1],$date[2]);   // Convert To Milady Date  2021  5  22 
        $date = implode('-',$date);  // 2021-5-22  implode Mikone
        // dd($date); 
        $this->attributes['from_date'] = $date;
        // }
    }

    public function getToDateAttribute($value)
    {
        $date = explode('-' , $value);
        $date = Verta::getJalali($date[0],$date[1],$date[2]);
        $date = implode('/' , $date);
        return $date;
    }

    public function setToDateAttribute($value)
    {
        $date = explode('/' , $value);
        $date = Verta::getGregorian($date[0],$date[1],$date[2]);
        $date = implode('-' , $date);
        // return $date;
        $this->attributes['to_date'] = $date;
    }


}


