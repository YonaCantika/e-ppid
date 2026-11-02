<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$m = DB::table('menu')->where('id', 2)->first();
echo "Link: " . $m->link . "\nStatus: " . $m->status . "\n";
