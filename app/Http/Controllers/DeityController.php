<?php

namespace App\Http\Controllers;

use App\Models\Deity;
use App\Models\DeityFamily;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DeityController extends Controller
{
    public function index()
    {
        $deities = Deity::with(['culture', 'class', 'legends'])
            ->orderBy('name')
            ->paginate(15);

        return view('deities.index', compact('deities'));
    }

    public function show(Deity $deity)
    {
        $familyRelations = DeityFamily::where('parent_id', $deity->id)
            ->orWhere('child_id', $deity->id)
            ->with(['parent', 'child'])
            ->get();

        $deityText = $deity->description;

        $deity->load(['culture']);
        return view('deities.show', [
            'deity' => $deity,
            'familyRelations' => $familyRelations,
            'deityText' => $deityText,
        ]);
    }

    public function search(Request $request)
    {
        $query = trim($request->input('search', ''));

        if ($query === '') {
            return redirect()->back()
                ->with('error', 'Inserire almeno un carattere.');
        }

        $deities = Deity::with('culture')
            ->where('name', 'like', "%{$query}%")
            ->paginate(10);

        return view('deities.search-results', [
            'deities' => $deities,
            'searchQuery' => $query,
        ]);
    }
}
