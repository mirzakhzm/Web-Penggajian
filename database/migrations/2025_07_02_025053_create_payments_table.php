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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salary_id')->nullable(false);
            $table->enum('status_pembayaran', ['pending', 'paid'])->default('pending');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamp('tanggal_pembayaran')->useCurrent();
          
            $table->foreign('salary_id')->references('id')->on('salaris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
