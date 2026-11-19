<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabel penerbit mungkin sudah ada dari praktikum PHP native (db_perpustakaan.sql).
        // Jangan dibuat ulang agar data lama tidak hilang.
        if (Schema::hasTable('penerbit')) {
            return;
        }

        Schema::create('penerbit', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_penerbit', 150);
            $table->string('nama_sales', 100);
            $table->string('kontak_sales', 50);
            $table->text('alamat');
            $table->string('wilayah_asal', 50);
            $table->timestamp('created_at')->useCurrent();
        });

        DB::table('penerbit')->insert([
            ['nama_penerbit' => 'Gramedia Pustaka Utama', 'nama_sales' => 'Aqila', 'kontak_sales' => '08123456789', 'alamat' => 'Jakarta', 'wilayah_asal' => 'Nasional'],
            ['nama_penerbit' => 'Open Library', 'nama_sales' => 'Putra', 'kontak_sales' => '08139876543', 'alamat' => 'Bandung', 'wilayah_asal' => 'Nasional'],
            ['nama_penerbit' => 'National University of Singapore Libraries', 'nama_sales' => 'Yuastana', 'kontak_sales' => '08112233445', 'alamat' => 'Singapura', 'wilayah_asal' => 'Internasional'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerbit');
    }
};
