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
               "spnish_body" => "",
           ],
           [
               "body" => "What Oregon county do you live in?",
               "question_number" => 2,
               "spnish_body" => "",
           ],
           [
               "body" => "We have a few questions to get you started. Select your preferred language:",
               "question_number" => 3,
               "spnish_body" => "",
           ],
           [
               "body" => "Are you 18+ years of age?",
               "question_number" => 4,
               "spnish_body" => "¿Tienes 18 años de edad?",
           ],
           [
               "body" => "Do you have a good driving record?",
               "question_number" => 5,
               "spnish_body" => "¿Tienes un buen historial de manejo?",
           ],
           [
               "body" => "Are you a US Citizen with a valid US driver’s license?",
               "question_number" => 6,
               "spnish_body" => "¿Es usted un ciudadano estadounidense con una licencia de conducir válida de los Estados Unidos?",
           ],
           [
               "body" => "Are you able to pass a drug screening test?",
               "question_number" => 7,
               "spnish_body" => "¿Eres capaz de pasar una prueba de detección de drogas?",
           ],
           [
               "body" => "Are you able to pass a physical?",
               "question_number" => 8,
               "spnish_body" => "¿Eres capaz de pasar un examen físico?",
           ],
           [
               "body" => "Thank you for your time. We will be in touch shortly to help you with the next steps.",
               "question_number" => 9,
               "spnish_body" => "Gracias por su tiempo. Nos pondremos en contacto en breve para ayudarle con los próximos pasos.",
           ],
           [
               "body" => "It appears you are not eligible for this program, however you may qualify for other programs offered by Worksource Oregon. Visit worksourceoregon.org for more details.",
               "question_number" => 10,
               "spnish_body" => "Parece que usted no es elegible para este programa; sin embargo, puede calificar para otros programas ofrecidos por Worksource Oregon. Visite worksourceoregon.org para obtener más detalles.",
           ]
       ]);
    }
}
