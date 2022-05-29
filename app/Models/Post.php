<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
protected $guarded = []; //Guarded spécifie les champs qui ne peuvent pas être affectés en masse. || Guarded pecifies the fields that cannot be assigned en masse. 

    public function user()
    {
        return $this->belongsTo(User::class); //Il appartiendra à un user ->belonsTo || It will be up to a user ->belonsTo
    }

    public function category()
    {
        return $this->belongsTo(Category::class); //Il appartiendra à une catégorie ->belonsTo || It will be up to a category ->belonsTo
    }
}
