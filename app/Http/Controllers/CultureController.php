<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use Illuminate\Support\Str; // Aggiungi questa riga

class CultureController extends Controller
{
    public function index()
    {
        $cultures = Culture::orderBy('name')->paginate(15);
        return view('cultures.index', compact('cultures'));
    }

    public function show(Culture $culture)
    {
        $culture->load(['deities', 'creatures', 'legends']);
        $slugName = Str::slug($culture->name); // Genera lo slug dal nome

        $cultureText = $culture->description;
        
        return view('cultures.show', [
            'culture' => $culture,
            'cultureText' => $cultureText,
            'slugName' => $slugName // Passa lo slug alla vista
        ]);
    }

    public function details(Culture $culture)
    {
        $culture->load(['deities', 'creatures', 'legends']);
        return view('cultures.details', [
            'culture' => $culture,
            'deities' => $culture->deities,
            'creatures' => $culture->creatures,
            'legends' => $culture->legends
        ]);
    }
}