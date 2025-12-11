<?php

namespace App\Http\Controllers;

use App\Models\Legend;
use Illuminate\Http\Request;

class LegendApiController extends Controller
{
    public function index()
    {
        $legends = Legend::with(['culture', 'deities', 'creatures'])
            ->orderBy('title')
            ->where('is_verified', true)
            ->paginate(10);

        return response()->json($legends);
    }
}
