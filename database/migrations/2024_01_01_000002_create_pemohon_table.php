<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemohon', function (Blueprint $table) {
            $table->id('id_pemohon');
            $table->integer('id_jenis')->nullable();
            $table->integer('id_identitas')->nullable();
            $table->string('nomor_identitas', 50)->nullable();
            $table->string('nama')->nullable();
            $table->string('npwp', 50)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('notelp', 20)->nullable();
            $table->string('nofax', 20)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('ktp')->nullable();
            $table->text('akta')->nullable();
            $table->integer('status')->default(0);
            $table->string('kode_unik', 255)->nullable();
            $table->timestamp('lastLogin')->nullable();
            $table->timestamps(); // includes createDate (created_at) and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemohon');
    }
};
