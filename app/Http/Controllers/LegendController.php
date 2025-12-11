<?php

namespace App\Http\Controllers;

use App\Models\Legend;
use Illuminate\Http\Request;

class LegendController extends Controller
{
    public function index()
    {
        $legends = Legend::with(['culture', 'deities', 'creatures'])
            ->orderBy('title')
            ->where('is_verified', true)
            ->paginate(10);

        return view('legends.index', compact('legends'));
    }

    public function show(Legend $legend)
    {
        $legendText = $legend->content;

        $legend->load(['deities', 'creatures']);
        return view('legends.show', [
            'legend' => $legend,
            'legendText' => $legendText
        ]);
    }


    
    public function search(Request $request)
    {
        $query = trim($request->input('q', ''));

        if (strlen($query) < 1) {
            return redirect()->back()->with('error', 'Inserire almeno un carattere.');
        }

        $legends = Legend::with(['culture'])
            ->where('title', 'like', "%{$query}%") // Solo ricerca per titolo
            ->where('is_verified', true) // Filtra solo quelle verificate (opzionale)
            ->paginate(10);

        return view('legends.search-results', [
            'legends' => $legends,
            'query' => $query,
        ]);
    }

}