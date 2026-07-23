<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel ini menyimpan menu yang DIBLOKIR per user.
     * Logika: jika row ada => menu diblokir. Tidak ada row => menu boleh diakses (default allow).
     *
     * user_type = 'admin'   → user_id merujuk ke tabel users (guard web)
     * user_type = 'pemohon' → user_id merujuk ke tabel pemohon (guard pemohon)
     */
    public function up(): void
    {
        Schema::create('user_menu_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('user_type', 10)->default('admin'); // 'admin' | 'pemohon'
            $table->string('menu_key', 60);   // e.g. 'permohonan', 'pemohon_list', 'view_menu'
            $table->timestamps();

            // Unique constraint: satu user hanya bisa punya satu entri per menu_key
            $table->unique(['user_id', 'user_type', 'menu_key'], 'uniq_user_menu');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_menu_permissions');
    }
};
