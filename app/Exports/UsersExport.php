<?php

namespace App\Exports;

use App\Models\SurveyUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $returnArr = [];
        $res = SurveyUser::get();
        //echo "<pre>";print_r($res);//die;
        foreach($res as $key => $user){
            $returnArr[$key]["name"] = $user->name;
            $returnArr[$key]["country"] = $user->country;
            $returnArr[$key]["phone"] = $user->phn_number;
            
            if($user->currnet_question == 1){
                $returnArr[$key]["status"] =  "Started";
            }elseif($user->currnet_question > 1 && $user->currnet_question < 8){
                $returnArr[$key]["status"] = "In progress";
            }elseif($user->currnet_question == 8){
                $returnArr[$key]["status"] = "Accepted";
            }elseif($user->currnet_question == 9){
                $returnArr[$key]["status"] = "Rejected";
            }
        }
        
     
        $returnArr = collect($returnArr);
        //echo "<pre>";print_r($returnArr);die;
        return $returnArr;
    }
    
    public function headings(): array
    {
        return [
            'Name',
            'Country',
            'Phone Number',
            'Status'
        ];
    }
}
