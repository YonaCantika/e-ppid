<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

DB::table('menu')->where('judul', 'Kalender Kerja')->update(['sub_menu' => 1, 'id_menu' => 4]);
echo "Updated Kalender Kerja to Child of Informasi Publik\n";
