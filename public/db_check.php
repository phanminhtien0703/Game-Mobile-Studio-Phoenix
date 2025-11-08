<?php

use Illuminate\Support\Facades\DB;

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->make(Illuminate\Contracts\Http\Kernel::class);

try {
    DB::connection()->getPdo();
    echo "Database connection is successful.";
} catch (Exception $e) {
    echo "Could not connect to the database. Error: " . $e->getMessage();
}