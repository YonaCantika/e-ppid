<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$menus = DB::table('menu')->get();
foreach($menus as $m) {
    echo $m->id . ' | ' . $m->judul . ' | id_menu:' . $m->id_menu . ' | sub_menu:' . $m->sub_menu . ' | static:' . $m->static . ' | status:' . $m->status . ' | status_link:' . $m->status_link . ' | link:' . $m->link . "\n";
}
