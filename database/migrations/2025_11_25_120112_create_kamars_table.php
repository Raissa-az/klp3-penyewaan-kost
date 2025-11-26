<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kost_id')->constrained()->onDelete('cascade');

            // perbaikan nama kolom
            $table->string('nomor'); 

            // tambahan kolom yg dipakai di form
            $table->string('tipe_kamar');
            $table->integer('harga');

            $table->enum('status', ['tersedia', 'terbooking', 'disewa'])
                  ->default('tersedia');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
