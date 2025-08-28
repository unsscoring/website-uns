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
        Schema::create('kejuaraan_kategoris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kejuaraans_id');
            $table->unsignedBigInteger('ref_kategoris_id');
            $table->boolean('multi_atlet')->default(true);
            $table->integer('swp');
            $table->string('bobot')->nullable();
            $table->timestamps();

            $table->foreign('kejuaraans_id')->references('id')->on('kejuaraans')->onDelete('cascade');
            $table->foreign('ref_kategoris_id')->references('id')->on('ref_kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejuaraan_kategoris');
    }
};
