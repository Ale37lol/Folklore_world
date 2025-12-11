<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CreatureApiController extends Controller
{
    public function index()
    {
        $creatures = Creature::with(['culture', 'class'])
            ->orderBy('name')
            ->paginate(15);

        return response()->json($creatures);
    }

}