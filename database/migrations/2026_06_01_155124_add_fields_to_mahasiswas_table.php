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
        Schema::table('mahasiswas', function (Blueprint $table) {
            // Tambah kolom yang belum ada dari model $fillable
            if (! \Schema::hasColumn('mahasiswas', 'no_hp')) {
                $table->string('no_hp', 20)->nullable()->after('angkatan');
            }
            if (! \Schema::hasColumn('mahasiswas', 'alamat')) {
                $table->text('alamat')->nullable()->after('no_hp');
            }
            if (! \Schema::hasColumn('mahasiswas', 'nama_ayah')) {
                $table->string('nama_ayah', 100)->nullable()->after('alamat');
            }
            if (! \Schema::hasColumn('mahasiswas', 'nama_ibu')) {
                $table->string('nama_ibu', 100)->nullable()->after('nama_ayah');
            }
            if (! \Schema::hasColumn('mahasiswas', 'pekerjaan_ayah')) {
                $table->string('pekerjaan_ayah', 100)->nullable()->after('nama_ibu');
            }
            if (! \Schema::hasColumn('mahasiswas', 'pekerjaan_ibu')) {
                $table->string('pekerjaan_ibu', 100)->nullable()->after('pekerjaan_ayah');
            }
            if (! \Schema::hasColumn('mahasiswas', 'penghasilan_ortu')) {
                $table->unsignedBigInteger('penghasilan_ortu')->nullable()->after('pekerjaan_ibu');
            }
            if (! \Schema::hasColumn('mahasiswas', 'ipk')) {
                $table->decimal('ipk', 3, 2)->nullable()->after('penghasilan_ortu');
            }
            if (! \Schema::hasColumn('mahasiswas', 'prestasi')) {
                $table->decimal('prestasi', 5, 2)->nullable()->after('ipk');
            }
            if (! \Schema::hasColumn('mahasiswas', 'keaktifan_org')) {
                $table->decimal('keaktifan_org', 5, 2)->nullable()->after('prestasi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn([
                'no_hp', 'alamat',
                'nama_ayah', 'nama_ibu',
                'pekerjaan_ayah', 'pekerjaan_ibu',
                'penghasilan_ortu', 'ipk',
                'prestasi', 'keaktifan_org',
            ]);
        });
    }
};
