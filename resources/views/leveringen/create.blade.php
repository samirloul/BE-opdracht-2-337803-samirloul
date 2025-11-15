@extends('layouts.app')
<!-- commit: US02-01 -->

@section('content')
    <h2>Nieuwe levering toevoegen</h2>

    <form action="{{ route('leveringen.store') }}" method="POST">
        @csrf

        {{-- LEVERANCIER --}}
        <label for="leverancier_id">Leverancier:</label><br>
        <select name="leverancier_id" id="leverancier_id" required>
            @foreach($leveranciers as $l)
                <option value="{{ $l->Id }}"
                    @if(isset($geselecteerdeLeverancierId) && $geselecteerdeLeverancierId == $l->Id) selected @endif>
                    {{ $l->Naam }}
                </option>
            @endforeach
        </select>
        <br><br>

        {{-- PRODUCT --}}
        <label for="product_id">Product:</label><br>
        <select name="product_id" id="product_id" required>
            @foreach($producten as $p)
                <option value="{{ $p->Id }}"
                    @if(isset($geselecteerdeProductId) && $geselecteerdeProductId == $p->Id) selected @endif>
                    {{ $p->Naam }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label for="datum_levering">Datum levering:</label><br>
        <input type="date" name="datum_levering" id="datum_levering" required>
        <br><br>

        <label for="aantal">Aantal geleverd:</label><br>
        <input type="number" name="aantal" id="aantal" min="1" required>
        <br><br>

        <label for="datum_volgende_levering">Datum eerstvolgende levering (optional):</label><br>
        <input type="date" name="datum_volgende_levering" id="datum_volgende_levering">
        <br><br>

        <button type="submit">✔ Levering opslaan</button>
    </form>
@endsection
