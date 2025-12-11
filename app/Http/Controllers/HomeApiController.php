<?php

namespace App\Http\Controllers;

use App\Models\Culture;
use App\Models\Deity;
use App\Models\Creature;

class HomeApiController extends Controller
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

            return response()->json([
                'cultures' => $cultures,
                'featured_deities' => $featuredDeities,
                'featured_creatures' => $featuredCreatures,
            ]);
            
    }
}
