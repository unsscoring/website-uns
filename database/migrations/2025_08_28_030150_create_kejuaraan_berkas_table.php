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
        Schema::create('kejuaraan_berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kejuaraans_id');
            $table->integer('no');
            $table->string('nama');
            $table->boolean('required')->default(true);
            $table->string('mimes');
            $table->timestamps();
            
            $table->foreign('kejuaraans_id')->references('id')->on('kejuaraans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejuaraan_berkas');
    }
};
