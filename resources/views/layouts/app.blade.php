<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Jamin Backend</title>
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
        <p style="color: green; font-weight: bold;">
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <main>
        @yield('content')
    </main>
</body>

</html>
