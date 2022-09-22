<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="/dist/output.css" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@2.2.4/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <title>Travel Library</title>

</head>

{{-- <body> --}}

{{-- 
    <ul>
        <li><a href="{{ route('post.index') }}">Accueil</a></li>
        <li><a href="{{ route('post.create') }}">New</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
     </ul>
    <div class="container mx-auto">@yield('content')</div> --}}
     {{-- <div id="app">
        
     </div>

    <script src="{{ asset('../../../frontend/public/js/app.js') }}"></script>
</body> --}}
<body>

  <div>
      <div>
          <div id="app" data-url="{{ env('APP_URL') }}">
          </div>
      </div>
  </div>

  <script type="text/javascript">
      const APP_URL = document.getElementById('app').dataset.url;
  </script>
      <script src="{{ asset('../../../frontend/public/js/app.js') }}"></script>

</body>


 </html> 
