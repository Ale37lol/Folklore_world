<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\Models\Deity;
use App\Models\Creature;
use App\Models\Legend;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $cultures = Culture::take(8)->get();
        $featuredDeities = Deity::with(['culture'])
            ->inRandomOrder()
            ->take(4)
            ->get();
        $featuredCreatures = Creature::with(['culture'])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('home', compact('cultures', 'featuredDeities', 'featuredCreatures'));
    }

    public function map()
    {
        $cultures = Culture::all();
        return view('map', compact('cultures'));
    }

    // In HomeController.php
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return redirect()->back()->with('error', 'Please enter a search term');
        }

        $deities = Deity::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->with(['culture'])
            ->take(5)
            ->get();

        $creatures = Creature::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->with(['culture'])
            ->take(5)
            ->get();

        $legends = Legend::where('title', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->with(['culture'])
            ->take(5)
            ->get();

        return view('search', compact('query', 'deities', 'creatures', 'legends'));
    }

    public function apiSearch(Request $request)
    {
        $q     = trim($request->input('q', ''));
        $limit = intval($request->input('limit', 10)); // default 10

        if (strlen($q) < 3) {
            return response()->json([
                'error' => 'Inserire almeno 3 caratteri per la ricerca.'
            ], 422);
        }

        $deities = Deity::with('culture')
            ->where('name', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->paginate($limit);

        $creatures = Creature::with('culture')
            ->where('name', 'like', "%{$q}%")
            ->orWhere('description', 'like', "%{$q}%")
            ->paginate($limit);

        $legends = Legend::with('culture')
            ->where('title', 'like', "%{$q}%")
            ->orWhere('content', 'like', "%{$q}%")
            ->paginate($limit);

        return response()->json(compact('deities', 'creatures', 'legends'));
    }
}