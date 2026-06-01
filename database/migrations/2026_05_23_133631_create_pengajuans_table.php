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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('beasiswa_id')->constrained('beasiswas')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'diverifikasi', 'dihitung', 'diterima', 'ditolak'])->default('menunggu');
            
            $table->text('catatan_dosen')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->float('skor_saw')->nullable();
            $table->integer('rank')->nullable();
            
            $table->string('dokumen_ktp')->nullable();
            $table->string('dokumen_kk')->nullable();
            $table->string('dokumen_sktm')->nullable();
            $table->string('dokumen_transkrip')->nullable();
            $table->string('dokumen_prestasi')->nullable();
            
            $table->timestamp('diverifikasi_at')->nullable();
            $table->timestamp('dihitung_at')->nullable();
            $table->timestamp('diputuskan_at')->nullable();
            
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
