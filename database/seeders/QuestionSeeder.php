<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Question::insert([
           [
               "body" => "Thanks for getting in touch! We are excited to help you change your life.What is your name?",
               "question_number" => 1,
           ],
           [
               "body" => "What Oregon county do you live in?",
               "question_number" => 2,
           ],
           [
               "body" => "We have a few questions to get you started. Select your preferred language:",
               "question_number" => 3,
           ],
           [
               "body" => "Are you 18+ years of age?",
               "question_number" => 4,
           ]
       ]);
    }
}
