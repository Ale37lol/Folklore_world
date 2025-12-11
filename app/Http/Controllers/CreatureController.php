<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
    public function show(Creature $creature)
    {
        $creature->load(['culture', 'legends']);

        $imageDir = public_path("storage/app/public/creatures/" . Str::slug($creature->name) . '/' . Str::slug($creature->name) . ' (1).jpeg');
        $images = [];
        if (file_exists($imageDir)) {
            $files = scandir($imageDir);
            foreach ($files as $file) {
                if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $images[] = asset("storage/app/public/creatures/" . Str::slug($creature->name) . "/" . $file);
                }
            }
        }

        $creatureText = $creature->description;

        return view('creatures.show', [
            'creature' => $creature,
            'creatureText' => $creatureText,
            'images' => $images
        ]);
    }


    public function index()
    {
        $creatures = Creature::with(['culture', 'class'])
            ->orderBy('name')
            ->paginate(15);

        return view('creatures.index', compact('creatures'));
    }

    public function search(Request $request)
    {
        $query = trim($request->input('search', ''));

        if ($query === '') {
            return redirect()->back()
                ->with('error', 'Inserire almeno un carattere.');
        }

        $creatures = Creature::with(['culture'])
            ->where('name', 'like', "%{$query}%")
            ->paginate(10);

        return view('creatures.search-results', [
            'creatures' => $creatures,
            'searchQuery' => $query,
        ]);
    }


}