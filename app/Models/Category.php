<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = []; //Guarded spécifie les champs qui ne peuvent pas être affectés en masse. || Guarded pecifies the fields that cannot be assigned en masse. 

    public function posts()
    {
        return $this->hasMany(Post::class); //Il y aura plusieurs posts qui appartiendront à la catégorie ->HasMany  //There will be several posts that will belong to the category ->HasMany
    }
}
