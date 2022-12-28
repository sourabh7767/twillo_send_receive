<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyUser extends Model
{
    use HasFactory;
    
     public static function getColumnForSorting($value){

        $list = [
            0=>'id',
            1=>'phn_number',
            2=>'name',
            3=>'country',
        ];

        return isset($list[$value])?$list[$value]:"";
    }
    
    public function getAllUsers($request = null,$flag = false)
    {
        $columnNumber = $request['order'][0]['column'];
        $order = $request['order'][0]['dir'];

        $column = self::getColumnForSorting($columnNumber);

        if($columnNumber == 0){
            $order = "desc";
        }

        if(empty($column)){
            $column = 'id';
        }
        $query = self::select("survey_users.*")->orderBy($column, $order);

        if(!empty($request)){

            $search = $request['search']['value'];

            if(!empty($search)){
                 $query->where(function ($query) use($request,$search){
                        $query->orWhere( 'phn_number', 'LIKE', '%'. $search .'%')
                            ->orWhere( 'name', 'LIKE', '%'. $search .'%')
                            ->orWhere( 'country', 'LIKE', '%'. $search .'%')
                            ->orWhere('users.created_at', 'LIKE', '%' . $search . '%');

                    });
                 
                  // if(is_int(stripos("Inactive", $search))){
                  //           $query->orWhere( 'status',  0);

                  //       }
                 // if(is_int(stripos("Active", $search))){
                 //            $query->orWhere( 'status',  1);

                 //        }
                       

                 if($flag)
                    return $query->count();
            }

            $start =  $request['start'];
            $length = $request['length'];
            $query->offset($start)->limit($length);


        }

        


        $query = $query->get();

        // print_r($query);
        // die();

        return $query;
    }
    
    public function answers(){
        return $this->hasMany(QuestionResponse::class,"survey_user_id","id");
    }
}
