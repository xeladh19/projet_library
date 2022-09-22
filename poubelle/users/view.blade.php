<h1>{{ $user->firstname }} {{ $user->lastname }}</h1>

<h3>Posts :</h3>

<ul>
    @foreach ($user->posts as $post)
        <li><a href="{{ route('post.view', ['post' => $post->slug]) }} ">{{ $post->title }}</a></li>
    @endforeach
</ul>

<a href="{{route('home')}}">Retour</a>
