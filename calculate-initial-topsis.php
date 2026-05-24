<?php

define('LARAVEL_START', microtime(true));

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\TopsisService;

try {
    echo "Starting initial AHP-TOPSIS calculation for all 25 citizens...\n";
    $topsisService = app(TopsisService::class);
    $result = $topsisService->calculateTOPSIS(7); // Calculate with quota = 7 (perfect for demo!)
    
    echo "SUCCESS: TOPSIS calculation complete.\n";
    echo "Total citizens analyzed: " . count($result['alternatives']) . "\n";
    echo "Quota set to: " . $result['quota'] . "\n";
    
    // Output top 7 ranked citizens
    echo "\nTOP 7 ELIGIBLE CITIZENS:\n";
    echo str_repeat("-", 80) . "\n";
    echo sprintf("%-5s | %-16s | %-25s | %-12s | %-12s | %-10s\n", "Rank", "NIK", "Nama Lengkap", "D+", "D-", "Preferensi");
    echo str_repeat("-", 80) . "\n";
    
    $counter = 0;
    foreach ($result['alternatives'] as $wId => $alt) {
        $counter++;
        if ($counter > 7) break;
        echo sprintf(
            "%-5d | %-16s | %-25s | %-12.4f | %-12.4f | %-10.5f\n",
            $alt['ranking'] ?? $counter,
            $alt['warga']->nik,
            $alt['warga']->nama_lengkap,
            $alt['d_plus'],
            $alt['d_minus'],
            $alt['v']
        );
    }
    echo str_repeat("-", 80) . "\n";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
