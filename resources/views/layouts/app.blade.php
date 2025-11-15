<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Jamin Backend</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- hier kun je later css/js includen --}}
</head>
<body>
    <header>
        <h1>Jamin</h1>
        <nav>
            <a href="{{ url('/') }}">Home</a> |
            <a href="{{ route('leveranciers.index') }}">Overzicht leveranciers</a> |
            <a href="{{ route('leveringen.create') }}">Nieuwe levering</a>
        </nav>
        <hr>
    </header>

    {{-- FLASH MELDINGEN --}}
   @if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif



   @if ($errors->any())
    <div class="alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <main>
        @yield('content')
    </main>
</body>

</html>
