<?php

namespace App\Http\Controllers;

use App\Models\Deity;
use App\Models\DeityFamily;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class DeityApiController extends Controller
{
    public function index()
    {
        $deities = Deity::with(['culture', 'class', 'legends'])
            ->orderBy('name')
            ->paginate(15);

        return response()->json($deities);
    }
}
