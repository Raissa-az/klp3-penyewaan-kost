<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kosts', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->enum('tipe', ['cewe','cowo','campuran'])->default('campuran');
            $table->integer('harga');
            $table->integer('jumlah_kamar')->default(0);
            $table->string('fasilitas')->nullable(); // misal: "Kasur,KM Dalam,Kipas,Dapur"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosts');
    }
};
