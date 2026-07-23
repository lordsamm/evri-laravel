<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Storage Link and File Investigation ===\n\n";

// Check if storage link exists
$publicStorage = public_path('storage');
if (is_link($publicStorage)) {
    echo "✓ public/storage is a symbolic link\n";
    echo "  Target: " . readlink($publicStorage) . "\n";
} elseif (is_dir($publicStorage)) {
    echo "⚠ public/storage exists but is NOT a symbolic link (it's a directory)\n";
} else {
    echo "❌ public/storage does NOT exist\n";
    echo "  Run: php artisan storage:link\n";
}

echo "\n";

// Check if payment-proofs directory exists
$paymentProofsDir = storage_path('app/public/payment-proofs');
if (is_dir($paymentProofsDir)) {
    echo "✓ storage/app/public/payment-proofs directory exists\n";
    
    // List files in payment-proofs directory
    $files = scandir($paymentProofsDir);
    echo "  Files:\n";
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $filePath = $paymentProofsDir . '/' . $file;
            echo "    - $file (" . filesize($filePath) . " bytes)\n";
        }
    }
} else {
    echo "❌ storage/app/public/payment-proofs directory does NOT exist\n";
}

echo "\n";

// Check if the specific file exists
$receiptPath = 'payment-proofs/t4b3oAWDJHoxhlGTtjraQqJv9AJDXNldCrpEPghs.png';
$fullPath = storage_path('app/public/' . $receiptPath);
if (file_exists($fullPath)) {
    echo "✓ File exists: $receiptPath\n";
    echo "  Full path: $fullPath\n";
    echo "  Size: " . filesize($fullPath) . " bytes\n";
} else {
    echo "❌ File does NOT exist: $receiptPath\n";
    echo "  Expected path: $fullPath\n";
}

echo "\n";

// Check what the asset() helper would generate
echo "=== Asset URL Generation ===\n";
echo "asset('storage/' . \$receipt_path) would generate:\n";
echo "  " . asset('storage/payment-proofs/t4b3oAWDJHoxhlGTtjraQqJv9AJDXNldCrpEPghs.png') . "\n";
