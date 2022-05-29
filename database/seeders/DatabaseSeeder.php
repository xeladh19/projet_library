<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = Category::factory(10)->create();
        User::factory(10)->create()->each(function($user) use ($categories){ //On va placer la méthode each qui vas permettre de passer un callback pour chaque utilisateur créé.||  We are going to place the each method which will allow to pass a callback for each created user. 
            Post::factory(rand(1,3))->create([ //A chaque fois qu'on aura crée un User on pourra définir un nouveau post
               'user_id' =>$user->id, //on passe le user ce qui nous permet d'avoir le user_id
               'category_id' => ($categories->random(1)->first())->id //On récupère de manière aléatoire les catégories et on prend la premiere et on récupère l'id.
            ]);
        });

    }
}
