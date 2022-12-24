<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionResponse;
use Illuminate\Http\Request;
use Twilio\TwiML\MessagingResponse;

use Illuminate\Support\Facades\Log;
use App\Models\SurveyUser;
use App\Models\QuestionOption;

class SurveyController extends Controller
{
    public function responses(Request $request){
       // echo "here";
       Log::info($request->all());
       $response = new MessagingResponse();
       $userRes = SurveyUser::where("phn_number",$request->From)->first();
       if($userRes){
           if($userRes->currnet_question == 1){
               $userRes->name = $request->input(['Body']);
               $userRes->save();
           }
           $currentQuestion = Question::where("question_number",$userRes->currnet_question)->first();
           $options = QuestionOption::where("question_id",$currentQuestion->id)->pluck("answer","answer")->toArray();
           if($options){
                if(in_array($request->Body,$options)){
                    QuestionResponse::create([
                                'answer' => $request->input(['Body']),
                                'question_id' => $currentQuestion->id,
                                "survey_user_id" =>$userRes->id, 
                                'messages_id'=>$request->input(['MessageSid'])
                            ]);       
               }else{
                   $response->message(" Invalid Response.");
                   return response($response);
               }    
           }else{
              // echo $userRes->id;die;
               QuestionResponse::create([
                                'answer' => $request->input(['Body']),
                                'question_id' => $currentQuestion->id,
                                "survey_user_id" =>$userRes->id,
                                'messages_id'=>$request->input(['MessageSid'])
                            ]);
           }
           
           $nextNumber = $userRes->currnet_question = $userRes->currnet_question+1;
           $userRes->save();
           
           $number = $nextNumber;
           $question = Question::where("question_number",$number)->first();
           $response->message($question->body);
           return response($response);
       }else{
           $obj = new SurveyUser();
           $obj->phn_number = $request->From;
           $obj->currnet_question = 1;
           $obj->country = $request->FromCountry;
           $obj->save();
           
           $question = Question::where("question_number",1)->first();
            $response->message($question->body);
            return response($response);
       }
        // $response = new MessagingResponse();
        // $question_id = $request->cookie('question_id');

        // if ($question_id == 'deleted') {
        //     $question_id = null;
        // }

        // if($question_id !== null) {
        //     QuestionResponse::create([
        //         'answer' => $request->input(['Body']),
        //         'question_id' => $question_id,
        //         'messages_id'=>$request->input(['MessageSid'])
        //     ]);

        //     $next_question = Question::find($question_id + 1);

        //     if($next_question){
        //         return $this->nextQuestion($response, $next_question);
        //     }else{
        //         $response->message("Thank you for taking the time to complete this survey!");
        //         return $this->destroy($response);

        //     }
        // } else {
        //     $response->message(" Thank you for being a customer. Please help us improve our product and our service to you by completing this survey.");

        //     return $this->firstQuestion($response);
        // }
    }

    private function firstQuestion($response){
        $question = Question::orderBy('id', 'ASC')->get()->first();
        $response->message($question->body);
        return response($response)->withCookie(cookie('question_id',$question->id, 60));
    }

    private function nextQuestion($response,$question){
        $response->message($question->body);
        return response($response)->withCookie(cookie('question_id',$question->id, 60));
    }

    private function destroy($response){
        return response($response)->withCookie(\Cookie::forget('question_id'));
    }
}
