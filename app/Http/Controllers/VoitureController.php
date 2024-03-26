<?php

namespace App\Http\Controllers;

use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    public function index()
    {
        $voitures = Voiture::all();
        return response()->json($voitures);
    }

    public function estimateprix(Request $request)
    {
        $annee = $request->annee;
        $kilometrage = $request->kilometrage;
        $puissance = $request->puissance;

        $estimatedPrice = $annee * 1000 - $kilometrage * 0.1 + $puissance * 500;
        return response()->json(['estimated_price' => $estimatedPrice]);
    }
}
