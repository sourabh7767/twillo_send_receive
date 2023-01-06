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
               "body" => "We’re excited to help you enroll and receive your FREE CDL training!  ¡Estamos muy contentos de ayudarlo a inscribirse y recibir su capacitación CDL GRATUITA! Can you please enter your preferred language? ¿Puede ingresar su idioma preferido? Text ENG for English or ESP for Spanish",
               "question_number" => 1,
               "spnish_body" => "",
           ],
           [
               "body" => "Thanks! First, what is your full name?",
               "question_number" => 2,
               "spnish_body" => "¡Gracias! Primero, ¿Qué es tu nombre completo?",
           ],
           [
               "body" => "What Oregon county do you live in?",
               "question_number" => 3,
               "spnish_body" => "¿En qué condado de Oregón tiene residencia?",
           ],
        //   [
        //       "body" => "We have a few questions to get you started. Select your preferred language:",
        //       "question_number" => 3,
        //       "spnish_body" => "",
        //   ],
           [
               "body" => "To ensure that you qualify for our program please answer the following questions. With yes or no answers. Are you over the age of 18?",
               "question_number" => 4,
               "spnish_body" => "Para asegurarse que usted califica para nuestro programa, responda las siguientes preguntas. Con respuestas sí o no. ¿Eres mayor de 18 años?",
           ],
           [
               "body" => "Do you have a good driving record?",
               "question_number" => 5,
               "spnish_body" => "¿Tiene un buen historial de manejo?",
           ],
           [
               "body" => "Are you a US Citizen with a valid US driver’s license?",
               "question_number" => 6,
               "spnish_body" => "¿Es usted ciudadano de los EE. UU. con una licencia de conducir válida de los EE. UU.?",
           ],
           [
               "body" => "Are you able to pass a drug screening test and a doctor’s physical examination?",
               "question_number" => 7,
               "spnish_body" => "¿Puede pasar una prueba de detección de drogas y un examen físico médico?",
           ],
        //   [
        //       "body" => "Are you able to pass a physical?",
        //       "question_number" => 8,
        //       "spnish_body" => "¿Eres capaz de pasar un examen físico?",
        //   ],
           [
               "body" => "Thank you for your time. We will be in touch shortly to help you with the next steps.",
               "question_number" => 8,
               "spnish_body" => "Gracias por su tiempo. Nos pondremos en contacto en breve para ayudarle con los próximos pasos.",
           ],
           [
               "body" => "It appears you are not eligible for this program, however you may qualify for other programs offered by Worksource Oregon. Visit worksourceoregon.org for more details. If you disagree with this initial assessment, please call 541-860-8591 to determine your eligibility.To learn more about this program visit getafreecdl.com",
               "question_number" => 9,
               "spnish_body" => "Parece que no es elegible para este programa; sin embargo, puede calificar para otros programas ofrecidos por Worksource Oregon. Visite worksourceoregon.org para obtener más detalles. Si no está de acuerdo con esta evaluación inicial, llame al 541-860-8591 para determinar su elegibilidad.Obtenga más información sobre el programa en getafreecdl.com",
           ]
       ]);
    }
}
