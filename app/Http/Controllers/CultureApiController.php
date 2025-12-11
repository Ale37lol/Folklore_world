<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Culture;

class CultureApiController extends Controller
{
    public function index()
    {
        $cultures = Culture::orderBy('name')->paginate(15);
        return response()->json($cultures);
    }
}