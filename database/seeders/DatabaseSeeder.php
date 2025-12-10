<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Answer;
use App\Models\Question;
use App\Models\CategoryBlog;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Luis Soriano Zabala',
            'email' => 'luis.soriano.lesz@gmail.com',
        ]);
        $categories = CategoryBlog::factory(4)->create();
        $questions = Question::factory(30)->create([
            'category_blog_id' => fn() => $categories->random()->id,//ASIGNA UNA CATEGORIA ALEATORIA A LA PREGUNTA
            'user_id' => fn() => User::inRandomOrder()->first()->id,//ASIGNA UN USUARIO ALEATORIO A LA PREGUNTA
        ]);
        
        $answers = Answer::factory(50)->create([
            'question_id' => fn() => $questions->random()->id,//SE ASEGURA DE QUE LA RESPUESTA PERTENEZCA A UNA PREGUNTA EXISTENTE
            'user_id' => fn() => User::inRandomOrder()->first()->id,//ASIGNA UN USUARIO ALEATORIO A LA RESPUESTA
        ]);
        Comment::factory(100)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id,//ASIGNA UN USUARIO ALEATORIO AL COMENTARIO
            'comentable_id' => fn() => $answers->random()->id,//SE ASEGURA DE QUE EL COMENTARIO PERTENEZCA A UNA RESPUESTA EXISTENTE
            'comentable_type' => Answer::class,
            
        ]);
        Comment::factory(100)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id,//ASIGNA UN USUARIO ALEATORIO AL COMENTARIO
            'comentable_id' => fn() => $questions->random()->id,//SE ASEGURA DE QUE EL COMENTARIO PERTENEZCA A UNA RESPUESTA EXISTENTE
            'comentable_type' => Question::class,

        ]);

        

    }
}
