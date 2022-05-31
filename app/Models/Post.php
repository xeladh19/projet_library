<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    protected $guarded = [];                                        //Guarded spécifie les champs qui ne peuvent pas être affectés en masse. || Guarded pecifies the fields that cannot be assigned en masse. 

    public static function boot()
    {
        //On est obligé ici d'appeller les routes boot,parent.
        parent::boot();

        self::creating(function ($post) {                           //A la création du post et on va associer ce post a ses parents(category et user )
            $post->user()->associate(auth()->user()->id);           //On va pouvoir récupérer notre id de l'utilisateur connecté. 
            $post->category()->associate(request()->category);      //On place la request qu'on va pouvoir récuprer via le helper.
        });
        self::updating(function ($post) {
            $post->category()->associate(request()->category);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);                       //Il appartiendra à un user ->belonsTo || It will be up to a user ->belonsTo
    }

    public function category()
    {
        return $this->belongsTo(Category::class);                   //Il appartiendra à une catégorie ->belonsTo || It will be up to a category ->belonsTo
    }
    public function getTitle($attribute)
    {                       //A chaque fois que je fais un getTitle attribute je récupère l'attribute
        return Str::title($attribute);                              // Attribute est égal au titre de chaque item qui sera récupéré
    }
}
