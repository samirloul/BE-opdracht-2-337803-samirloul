@extends('layouts.app')

@section('content')
    <h2>Geleverde producten van: {{ $leverancier->Naam }}</h2>

    <a href="{{ route('leveranciers.index') }}">⬅ Terug naar overzicht</a>

    {{-- Scenario 02 US1: geen producten geleverd --}}
    @if (count($producten) === 0)
        <p style="color: red; font-weight: bold; margin-top: 20px;">
            Dit bedrijf heeft tot nu toe geen producten geleverd aan Jamin.
        </p>

        <script>
            // Na 3 seconden terug naar overzicht leveranciers
            setTimeout(function () {
                window.location.href = "{{ route('leveranciers.index') }}";
            }, 3000);
        </script>
    @else
        <table border="1" cellpadding="8" cellspacing="0" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>Productnaam</th>
                    <th>Aantal in magazijn</th>
                    <th>Laatste levering</th>
                    <th>Nieuwe levering</th>
                </tr>
            </thead>

            <tbody>
                @foreach($producten as $product)
                    <tr>
                        <td>{{ $product->ProductNaam }}</td>
                        <td>{{ $product->AantalInMagazijn }}</td>
                        <td>{{ $product->LaatsteLevering }}</td>
                        <td style="text-align: center;">
                            {{-- plus-icoon, straks gebruiken we dit voor US2 --}}
                            <a href="{{ route('leveringen.create', [
        'leverancier_id' => $leverancier->Id,
        'product_id'     => $product->ProductId
    ]) }}" title="Nieuwe levering">
    ➕
</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
