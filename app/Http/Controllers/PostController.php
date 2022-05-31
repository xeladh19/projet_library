<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\category;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->latest()->get();                               //Requête qui nous permet de récupérer tout les posts --- Pour diminuer le nombre de requête SQL on va réaliser un with('') pour envoyer une catégorie en même temps que le post
        return view('post.index', compact('posts'));                                            // Je lui passe la variable post au niveau de la vue
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));                                      // Ainsi nous avons accès a cette variable dans notre vue
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //On va devoir valider les informations passées en post ->php artisan make:request StorePostRequest
        $imageName = $request->image->store('posts');                                           //request->image->renvoit un objet particulier sur equel on peut utiliser la méthode store et on va le stocker dans un ('posts')->cela va créer un dossier post quis era situer dqns storage/app/public 
        //Il va ensuite gérer un nom aléatoirement pour l'image qu'il stockera dans ce dossier post et qui nous renverra en retour le nom de l'image
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName
        ]);

        return redirect()->route('dashboard')->with('success', 'Votre post à été créé');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));                                              // On lui renvoit le post que l'on récupère dans (Post $post)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        if (! Gate::denies('update-post', $post)) { //Denies => si on a pas le droit d'update le post ça fait une erreur 403
            abort(403);
        }

        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));                                // On doit placer categories en deuxieme paramètre de compact
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {

        if (! Gate::denies('update-post', $post)) { //Denies => si on a pas le droit d'update le post ça fait une erreur 403
            abort(403);
        }

        $arrayUpdate = [
            'title' => $request->title,
            'content' => $request->content
        ];
        //Si on a pas modifié d'image cette logique là ne sera pas faite !
        if ($request->image !== null) {                                                         //Si la request image (est-ce qu'elle est différente de null) -> dans ce cas là notre array update sera différent
            $imageName = $request->image->store('posts');                                       //Si notre request image != null on aura imageName qui sera égal au nom de l'image qui sera stocké à l'instant. On aura une image stockée.

            $arrayUpdate = array_merge($arrayUpdate, [
                'image' => $imageName                                                           //On aura le nom de l'image qui sera contenu dans notre array. 
            ]);
        }
        $post->update($arrayUpdate);
        return redirect()->route('dashboard')->with('success', 'Votre post à été modifié');     //On peut redirigé vers le dashboard.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
     
        if (Gate::denies('destroy-post', $post)) { //Denies => si on a pas le droit d'update le post ça fait une erreur 403
            abort(403);
        }

        $post->delete();
        
        return redirect()->route('dashboard')->with('success', 'Votre post à été supprimé');     //On peut redirigé vers le dashboard.

    }
}
