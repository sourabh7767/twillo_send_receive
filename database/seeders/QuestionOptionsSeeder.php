<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionOption;

class QuestionOptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionOption::insert([
            [
               "question_id" => 3,
               "answer" => "coos",
           ],
           [
               "question_id" => 3,
               "answer" => "curry",
           ],
           [
               "question_id" => 3,
               "answer" => "douglas",
           ],
           [
               "question_id" => 3,
               "answer" => "jackson",
           ],
           [
               "question_id" => 3,
               "answer" => "josephine",
           ],
           [
               "question_id" => 3,
               "answer" => "lane",
           ],
            [
               "question_id" => 4,
               "answer" => "yes",
           ],
           [
               "question_id" => 4,
               "answer" => "si",
           ],
           [
               "question_id" => 4,
               "answer" => "no",
           ],
           [
               "question_id" => 5,
               "answer" => "yes",
           ],
           [
               "question_id" => 5,
               "answer" => "si",
           ],
           [
               "question_id" => 5,
               "answer" => "no",
           ],
           [
               "question_id" => 6,
               "answer" => "yes",
           ],
           [
               "question_id" => 6,
               "answer" => "si",
           ],
           [
               "question_id" => 6,
               "answer" => "no",
           ],
           [
               "question_id" => 7,
               "answer" => "yes",
           ],
           [
               "question_id" => 7,
               "answer" => "si",
           ],
           [
               "question_id" => 7,
               "answer" => "no",
           ],
        //   [
        //       "question_id" => 8,
        //       "answer" => "yes",
        //   ],
        //   [
        //       "question_id" => 8,
        //       "answer" => "no",
        //   ]
       ]);
    }
}
