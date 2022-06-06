<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;


class generateContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:content';
    private $posts = [
        [
            'title' => 'Mon premier post',
            'content' => 'Contenu du content',
            'image' => 'https://st.depositphotos.com/1358992/1367/i/450/depositphotos_13674860-stock-photo-bus-van.jpg',
            'category_id' => 1
        ],
        [   'title' => 'Mon deuxième post',
            'content' => 'Contenu du content numero 2',
            'image' => 'https://static8.depositphotos.com/1405513/881/i/950/depositphotos_8814215-stock-photo-yellow-bus.jpg?forcejpeg=true',
            'category_id' => 2
        ]
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach($this->posts as $post){
            $post['user_id'] = rand(1,10);
            Post::create($post);
        }
        return 0;
    }
}
