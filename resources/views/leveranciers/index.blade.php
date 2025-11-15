@extends('layouts.app')
<!-- commit: US01-03 -->

@section('content')
    <h2>Overzicht leveranciers</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Contactpersoon</th>
                <th>Leveranciernummer</th>
                <th>Mobiel</th>
                <th>Aantal verschillende producten</th>
                <th>Toon producten</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leveranciers as $leverancier)
                <tr>
                    <td>{{ $leverancier->Naam }}</td>
                    <td>{{ $leverancier->ContactPersoon }}</td>
                    <td>{{ $leverancier->LeverancierNummer }}</td>
                    <td>{{ $leverancier->Mobiel }}</td>
                    <td>{{ $leverancier->AantalVerschillendeProducten }}</td>
                    <td style="text-align: center;">
                       <a href="{{ route('leveranciers.producten', $leverancier->Id) }}">
    📦
</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
