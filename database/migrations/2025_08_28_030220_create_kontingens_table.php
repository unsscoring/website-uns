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
        Schema::create('kontingens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('kejuaraans_id');
            $table->string('nama_kontingen');
            $table->longText('data_tambahan')->nullable();
            $table->unsignedBigInteger('status');
            $table->unsignedBigInteger('total_pembayaran')->nullable();
            $table->string('path_pembayaran')->nullable();
            $table->unsignedBigInteger('status_pembayaran')->nullable();
            $table->string('catatan_pembayaran')->nullable();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kejuaraans_id')->references('id')->on('kejuaraans')->onDelete('cascade');
            $table->foreign('status')->references('id')->on('ref_statuses')->onDelete('cascade');
            $table->foreign('status_pembayaran')->references('id')->on('ref_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontingens');
    }
};
