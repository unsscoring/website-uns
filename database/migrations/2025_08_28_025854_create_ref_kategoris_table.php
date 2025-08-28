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
        Schema::create('ref_kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->string('cabang'); // tanding, tunggal, ganda, beregu, solo
            $table->string('jenis'); // prestasi, pemasalan
            $table->string('bobot')->nullable();
            $table->unsignedBigInteger('golongans_id');
            $table->unsignedBigInteger('regulasis_id');
            $table->timestamps();

            $table->foreign('golongans_id')->references('id')->on('ref_golongans')->onDelete('cascade');
            $table->foreign('regulasis_id')->references('id')->on('ref_regulasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_kategoris');
    }
};
