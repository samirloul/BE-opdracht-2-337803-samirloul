<?php

namespace App\Http\Controllers;
// commit: US01-05

use App\Models\Leverancier;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeverancierController extends Controller
{
    public function index()
    {
        // Haal data uit stored procedure
        $leveranciers = DB::select('CALL spGetLeveranciersMetAantalProducten()');

        return view('leveranciers.index', [
            'leveranciers' => $leveranciers,
        ]);
    }

    // deze maken we later voor het detailscherm (box-icoon)
public function showProducts($leverancierId)
{
    $leverancier = \App\Models\Leverancier::find($leverancierId);

    if (!$leverancier) {
        abort(404, 'Leverancier niet gevonden');
    }

    // Nieuwe stored procedure aanroepen
    $producten = DB::select(
        'CALL spGetGeleverdeProductenVoorLeverancier(?)',
        [$leverancierId]
    );

    return view('leveranciers.producten', [
        'leverancier' => $leverancier,
        'producten'   => $producten,
    ]);
}

public function createLevering(Request $request)
{
    $leveranciers = Leverancier::all();
    $producten    = Product::all();

    $geselecteerdeLeverancierId = $request->query('leverancier_id');
    $geselecteerdeProductId     = $request->query('product_id');

    return view('leveringen.create', compact(
        'leveranciers',
        'producten',
        'geselecteerdeLeverancierId',
        'geselecteerdeProductId'
    ));
}




public function storeLevering(Request $request)
{
    // Validatie
    $request->validate([
        'leverancier_id' => 'required|integer',
        'product_id' => 'required|integer',
        'datum_levering' => 'required|date',
        'aantal' => 'required|integer|min:1',
        'datum_volgende_levering' => 'nullable|date',
    ]);

    // Leverancier + product laden
    $leverancier = Leverancier::find($request->leverancier_id);
    $product     = Product::find($request->product_id);

    if (!$leverancier || !$product) {
        abort(404, 'Leverancier of product niet gevonden');
    }

    // === US02 - Scenario 2: product niet meer actief ===
    if ($product->IsActief === false) {
        return view('leveringen.product_niet_actief', [
            'leverancier' => $leverancier,
            'product'     => $product,
        ]);
    }

    // === US02 - Scenario 1: normale levering opslaan ===
    DB::statement('CALL spInsertLevering(?, ?, ?, ?, ?)', [
        $request->leverancier_id,
        $request->product_id,
        $request->datum_levering,
        $request->aantal,
        $request->datum_volgende_levering
    ]);

    return redirect()
        ->route('leveranciers.producten', $leverancier->Id)
        ->with('success', 'Levering succesvol toegevoegd!');
}



}
