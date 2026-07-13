<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('background', function (Blueprint $table) {
            $table->id();
            $table->string('gambar', 255);
            $table->timestamps();
        });

        Schema::create('informasi', function (Blueprint $table) {
            $table->id('informasi_id');
            $table->integer('kategori_id')->nullable();
            $table->integer('menu_id')->nullable();
            $table->text('judul')->nullable();
            $table->integer('tipe')->default(0);
            $table->string('link', 200)->nullable();
            $table->string('status', 1)->nullable();
            $table->timestamps(); // menggantikan datetime
        });

        Schema::create('informasi_permohonan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pemohon')->nullable();
            $table->string('tipe_permohonan', 50)->nullable();
            $table->string('tipe_lainnya', 255)->nullable();
            $table->text('isi_permohonan')->nullable();
            $table->string('status', 15)->nullable();
            $table->string('upload_file', 255)->nullable();
            $table->text('text_file')->nullable();
            $table->integer('id_admin')->nullable();
            $table->timestamps(); // menggantikan entry_date & update_date
        });

        Schema::create('kategori', function (Blueprint $table) {
            $table->id('kategori_id');
            $table->string('nama_kategori', 200)->nullable();
            $table->integer('urutan')->nullable();
            $table->string('status', 1)->default('0');
            $table->timestamps(); // menggantikan datetime
        });

        Schema::create('kontak', function (Blueprint $table) {
            $table->id();
            $table->string('alamat', 255);
            $table->string('alamat_produksi', 255);
            $table->string('telp', 20);
            $table->string('fax', 100);
            $table->string('email', 100);
            $table->string('fb', 255);
            $table->string('google', 255);
            $table->string('twitter', 255);
            $table->string('instagram', 255);
            $table->timestamps();
        });

        Schema::create('logo', function (Blueprint $table) {
            $table->id();
            $table->string('gambar', 255);
            $table->timestamps();
        });

        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255)->nullable();
            $table->string('judul_en', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->integer('id_menu')->nullable();
            $table->integer('urut');
            $table->integer('sub_menu')->nullable();
            $table->integer('status');
            $table->integer('static');
            $table->string('link', 100)->nullable();
            $table->string('status_link', 20);
            $table->timestamps();
        });

        Schema::create('regulasi', function (Blueprint $table) {
            $table->id('regulasi_id');
            $table->text('aturan')->nullable();
            $table->text('keterangan')->nullable();
            $table->enum('tipe_file', ['IMG', 'PDF', ''])->nullable();
            $table->text('file')->nullable();
            $table->string('status', 1)->default('0');
            $table->timestamps(); // menggantikan datetime
        });

        Schema::create('tb_api_wa', function (Blueprint $table) {
            $table->id();
            $table->text('api_wa');
            $table->string('link', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('background');
        Schema::dropIfExists('informasi');
        Schema::dropIfExists('informasi_permohonan');
        Schema::dropIfExists('kategori');
        Schema::dropIfExists('kontak');
        Schema::dropIfExists('logo');
        Schema::dropIfExists('menu');
        Schema::dropIfExists('regulasi');
        Schema::dropIfExists('tb_api_wa');
    }
};
