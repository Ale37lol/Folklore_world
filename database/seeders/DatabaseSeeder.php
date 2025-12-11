<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Photo;
use App\Models\Culture;
use App\Models\MythClass;
use App\Models\Deity;
use App\Models\Creature;
use App\Models\Legend;
use App\Models\DeityFamily;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CulturesTableSeeder::class,
            MythClassesTableSeeder::class,
            DeitiesTableSeeder::class,
            CreaturesTableSeeder::class,
            LegendsTableSeeder::class,
            DeityFamilyTableSeeder::class,
        ]);
    }

}