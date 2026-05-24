<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use App\Services\AhpService;

class AhpSeeder extends Seeder
{
    /**
     * Run the database seeds to establish initial consistent AHP weights.
     */
    public function run(): void
    {
        $c1 = Kriteria::where('kode', 'C1')->first();
        $c2 = Kriteria::where('kode', 'C2')->first();
        $c3 = Kriteria::where('kode', 'C3')->first();
        $c4 = Kriteria::where('kode', 'C4')->first();
        $c5 = Kriteria::where('kode', 'C5')->first();

        if (!$c1 || !$c2 || !$c3 || !$c4 || !$c5) {
            return;
        }

        // Establish perfectly consistent matrix values
        // C1 = 0.30, C2 = 0.25, C3 = 0.20, C4 = 0.15, C5 = 0.10
        $matrix = [
            $c1->id => [
                $c2->id => 1.2,
                $c3->id => 1.5,
                $c4->id => 2.0,
                $c5->id => 3.0,
            ],
            $c2->id => [
                $c3->id => 1.25,
                $c4->id => 1.6667,
                $c5->id => 2.5,
            ],
            $c3->id => [
                $c4->id => 1.3333,
                $c5->id => 2.0,
            ],
            $c4->id => [
                $c5->id => 1.5,
            ]
        ];

        $ahpService = new AhpService();
        $ahpService->saveMatrix($matrix);
    }
}
