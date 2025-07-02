<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_karyawan')->nullable(false);
            $table->string('bulan')->nullable(false);
            $table->decimal('gaji_pokok', 10, 2)->nullable(false);
            $table->decimal('bonus', 10, 2)->nullable(false);
            $table->decimal('pajak', 10, 2)->nullable(false);
            $table->decimal('total_diterima', 10, 2)->nullable(false);
            $table->enum('status_pengajuan', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('notes')->nullable();
            $table->timestamp('tanggal_pengajuan')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaris');
    }
};
