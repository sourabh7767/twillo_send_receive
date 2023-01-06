<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionResponse;
use Illuminate\Http\Request;
use Twilio\TwiML\MessagingResponse;

use Illuminate\Support\Facades\Log;
use App\Models\SurveyUser;
use App\Models\QuestionOption;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;

class SurveyController extends Controller
{
    public function responses(Request $request){
       // echo "here";
       $receiverNumber = "+919857431801";
       
       Log::info($request->all());
       $response = new MessagingResponse();
       $userRes = SurveyUser::where("phn_number",$request->From)->first();
       if($userRes){
           if($userRes->currnet_question == 8 || $userRes->currnet_question == 9){ // when last question is done or no is answered
            $response->message("Survey Completed");
            return response($response);   
           }
           if($userRes->currnet_question == 2){ // on this we save name
               $userRes->name = $request->input(['Body']);
               $userRes->save();
           }
           
           if($userRes->currnet_question == 1){
               if(in_array(strtolower(trim($request->Body)),["english","spanish","espanol","eng","esp"])){
                   $userRes->language = $request->input(['Body']);
                    $userRes->save();
               }else{
                   $response->message("Your answer isn't a valid response to our query. This program is available to Oregon residents of Coos, Curry, Douglas, Jackson, Josephine, and Lane counties. Please try to answer the question again or call us at 541-860-8591 Monday - Friday from 8 -5pm and we will help determine your eligibility to get you started.");
                   return response($response);
               }
           }
           $currentQuestion = Question::where("question_number",$userRes->currnet_question)->first();
           $options = QuestionOption::where("question_id",$currentQuestion->id)->pluck("answer","answer")->toArray();
           if($options){
               //echo "<pre>";print_r($options);//die;
                if(in_array(strtolower(trim($request->Body)),$options)){
                    //echo "here";die;
                    if(strtolower(trim($request->Body)) == "no"){
                       // echo "no";die;
                        $nextNumber = $userRes->currnet_question = 9;
                        $userRes->save();
                    //     $question = Question::where("question_number",$nextNumber)->first();
                        
                    //     $userResNew = SurveyUser::where("phn_number",$request->From)->first();
                    //   if($userResNew->language && strtolower($userResNew->language) == "spanish"){
                    //         $response->message($question->spnish_body);
                    //   }else{
                    //         $response->message($question->body);    
                    //   }
                    }else{
                      //  echo "yes";die;
                        $nextNumber = $userRes->currnet_question = $userRes->currnet_question+1;
                        $userRes->save();
                    }
                    
                    QuestionResponse::create([
                                'answer' => $request->input(['Body']),
                                'question_id' => $currentQuestion->id,
                                "survey_user_id" =>$userRes->id, 
                                'messages_id'=>$request->input(['MessageSid'])
                            ]);       
               }else{
                   //echo "bye";die;
                   if($userRes->currnet_question == 3){
                       QuestionResponse::create([
                                'answer' => $request->input(['Body']),
                                'question_id' => $currentQuestion->id,
                                "survey_user_id" =>$userRes->id, 
                                'messages_id'=>$request->input(['MessageSid'])
                            ]);       
                       $nextNumber = $userRes->currnet_question = 9;
                        $userRes->save();
                   }else{
                        if($userResNew->language && (strtolower($userResNew->language) == "spanish" || strtolower($userResNew->language) == "espanol"  || strtolower($userResNew->language) == "esp")){
                            $response->message("Your answer isn't a valid response to our query. This program is available to Oregon residents of Coos, Curry, Douglas, Jackson, Josephine, and Lane counties. Please try to answer the question again or call us at 541-860-8591 Monday - Friday from 8 -5pm and we will help determine your eligibility to get you started.");    
                       }else{
                           $response->message("Su respuesta no es una respuesta válida a nuestra consulta. Este programa está disponible para los residentes de Oregón de los condados de Coos, Curry, Douglas, Jackson, Josephine y Lane. Intente responder la pregunta nuevamente o llámenos al 541-860-8591 de lunes a viernes de 8 a 5 p. m. y lo ayudaremos a determinar su elegibilidad para comenzar.");
                       }
                       
                       return response($response);    
                   }
                   
               }    
           }else{
              // echo $userRes->id;die;
               QuestionResponse::create([
                                'answer' => $request->input(['Body']),
                                'question_id' => $currentQuestion->id,
                                "survey_user_id" =>$userRes->id,
                                'messages_id'=>$request->input(['MessageSid'])
                            ]);
                $nextNumber = $userRes->currnet_question = $userRes->currnet_question+1;
                $userRes->save();            
           }
           
           
           
           $number = $nextNumber;
           $question = Question::where("question_number",$number)->first();
           if($number == 8){ // success
               $this->sendMessage("success message",$receiverNumber);
           }
           
           if($number == 9){ // falier
               $this->sendMessage("Failer message",$receiverNumber);
           }
           $userResNew = SurveyUser::where("phn_number",$request->From)->first();
           if($userResNew->language && (strtolower($userResNew->language) == "spanish" || strtolower($userResNew->language) == "espanol" || strtolower($userResNew->language) == "esp")){
                $response->message($question->spnish_body);
           }else{
                $response->message($question->body);    
           }
           
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
    
    public function sendMessage($message,$receiverNumber){
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_TOKEN");
        $twilio_number = getenv("TWILIO_FROM");

        $client = new Client($account_sid, $auth_token);
        $data = $client->messages->create($receiverNumber, [
            'from' => $twilio_number, 
            'body' => $message]);
        return true;    
    }
    
    public function voiceResponses(request $request){
        $response = new VoiceResponse();
         $response->say('Please leave a message at the beep. Press the star key when finished.');
         echo $response;
    }
}
