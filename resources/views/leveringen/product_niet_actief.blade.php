@extends('layouts.app')
<!-- commit: US02-04 -->

@section('content')
    <h2>Levering product</h2>

    <p style="color: red; font-weight: bold; margin-top: 20px;">
        Het product {{ $product->Naam }} van de leverancier {{ $leverancier->Naam }} wordt niet meer geproduceerd.
    </p>

    <p>Je wordt automatisch teruggestuurd naar het overzicht van geleverde producten...</p>

    <script>
        setTimeout(function () {
            window.location.href = "{{ route('leveranciers.producten', $leverancier->Id) }}";
        }, 4000);
    </script>
@endsection
