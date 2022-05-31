<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
                                                            //Dans le cas ou il y aurait la possibilité de placer l'image en nullable
        if (request()->routeIs('posts.store')){             //Si la route est posts.store cela veut dire que l'on est entrain de créer un post et dans ce cas la imageRule = image\Required
            $imageRule = 'image|required';

        }elseif(request()->routeIs('posts.update')){
            $imageRule = 'image|sometimes';                   //Sometimes -> Si l'informations e retrouve dans la request alors elle est required sinon elle n'est pas obligatoire
        }
        return [
            'title' =>'required',
            'content' =>'required',
            'image' =>$imageRule,
            'category' =>'required'
        ];
    }
    protected function prepareForValidation()
    {
        if($this->image == null) {                            //$this fera directement appel à la request 
            $this->request->remove('image');                  //càd -> l'image est null donc on va la retirer de la request -> et donc valider le sometimes et il ne sera pas dans la request 
        }
    }
}
