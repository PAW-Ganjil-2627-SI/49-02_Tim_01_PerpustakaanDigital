<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('buku')) {
            return;
        }

        Schema::create('buku', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('judul', 150);
            $table->string('isbn', 20);
            $table->integer('tahun_terbit');
            $table->string('pengarang', 100);
            $table->string('kategori', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};

