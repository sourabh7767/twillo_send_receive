<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResponse extends Model
{
    use HasFactory;
    
    protected $fillable = [
       'answer', 'question_id', 'messages_id','survey_user_id'
   ];
   
   public function questions(){
      return  $this->hasOne(Question::class,"id","question_id");
   }
}
