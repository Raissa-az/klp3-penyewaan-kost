<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('kamars', function (Blueprint $table) {
        if (!Schema::hasColumn('kamars', 'tipe_kamar')) {
            $table->string('tipe_kamar')->nullable();
        }

        if (!Schema::hasColumn('kamars', 'harga')) {
            $table->integer('harga')->default(0);
        }

        if (!Schema::hasColumn('kamars', 'deskripsi')) {
            $table->text('deskripsi')->nullable();
        }
    });
}

public function down()
{
    Schema::table('kamars', function (Blueprint $table) {
        $table->dropColumn(['tipe_kamar', 'harga', 'deskripsi']);
    });
}

};
