<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // ==========================================
        // 1. Buat 1 Dosen Pembimbing
        // ==========================================
        $userDosen = User::firstOrCreate(
            ['email' => 'dosen@scholaris.ac.id'],
            [
                'name'     => 'Dr. Budi Santoso, M.Kom.',
                'password' => Hash::make('password'),
                'role'     => User::ROLE_DOSEN,
            ]
        );

        // Cari atau buat record di tabel dosens
        $dosenRecord = \Illuminate\Support\Facades\DB::table('dosens')->where('user_id', $userDosen->id)->first();
        if (!$dosenRecord) {
            $dosenId = \Illuminate\Support\Facades\DB::table('dosens')->insertGetId([
                'user_id'    => $userDosen->id,
                'nip'        => '198001012005011001',
                'prodi'      => 'Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $dosenId = $dosenRecord->id;
        }

        $this->command->info('Dosen berhasil dibuat: dosen@scholaris.ac.id | password: password');

        // ==========================================
        // 2. Buat Data Beasiswa Aktif
        // ==========================================
        $beasiswa = \App\Models\Beasiswa::firstOrCreate(
            ['nama' => 'Beasiswa Prestasi & Bantuan Scholaris 2026'],
            [
                'kuota'    => 10,
                'deadline' => now()->addDays(30),
                'status'   => 'aktif',
            ]
        );
        $this->command->info('Data Beasiswa Aktif berhasil dibuat.');

        // ==========================================
        // 3. Buat 20 Mahasiswa Bimbingan
        // ==========================================
        $prodiList = ['Teknik Informatika', 'Sistem Informasi', 'Ilmu Komputer', 'Teknologi Informasi'];
        $pekerjaanList = ['PNS', 'Wiraswasta', 'Pegawai Swasta', 'Petani', 'Buruh', 'TNI/Polri', 'Guru'];

        for ($i = 1; $i <= 20; $i++) {
            // a. Buat Akun User untuk Mahasiswa
            // Gunakan email terprediksi: mhs1@scholaris.ac.id s.d. mhs20@scholaris.ac.id
            $emailMhs = "mhs{$i}@scholaris.ac.id";
            
            $userMhs = User::firstOrCreate(
                ['email' => $emailMhs],
                [
                    'name'     => $faker->name,
                    'password' => Hash::make('password'),
                    'role'     => User::ROLE_MAHASISWA,
                ]
            );

            // b. Buat Data Profil Mahasiswa
            $mahasiswa = Mahasiswa::firstOrCreate(
                ['user_id' => $userMhs->id],
                [
                    'dosen_id'         => $dosenId, // Relasikan ke dosen yang baru dibuat
                    'nim'              => '20' . $faker->unique()->numerify('######'),
                    'prodi'            => $faker->randomElement($prodiList),
                    'angkatan'         => $faker->numberBetween(2020, 2023),
                    'no_hp'            => $faker->phoneNumber,
                    'alamat'           => $faker->address,
                    'nama_ayah'        => $faker->name('male'),
                    'nama_ibu'         => $faker->name('female'),
                    'pekerjaan_ayah'   => $faker->randomElement($pekerjaanList),
                    'pekerjaan_ibu'    => $faker->randomElement(array_merge($pekerjaanList, ['Ibu Rumah Tangga'])),
                    'penghasilan_ortu' => $faker->numberBetween(1000000, 10000000), // Rp 1 juta - 10 juta
                    'ipk'              => $faker->randomFloat(2, 2.75, 4.00), // 2.75 - 4.00
                    'prestasi'         => $faker->randomFloat(2, 50, 100), // 50 - 100
                    'keaktifan_org'    => $faker->randomFloat(2, 50, 100), // 50 - 100
                ]
            );

            // c. Buat Data Pengajuan (Supaya muncul di Dashboard Admin dan Dosen)
            \App\Models\Pengajuan::firstOrCreate(
                ['mahasiswa_id' => $mahasiswa->id],
                [
                    'beasiswa_id' => $beasiswa->id,
                    'status' => \App\Models\Pengajuan::STATUS_MENUNGGU,
                    'dokumen_ktp' => 'dummy_ktp.pdf',
                    'dokumen_kk' => 'dummy_kk.pdf',
                    'dokumen_sktm' => 'dummy_sktm.pdf',
                    'dokumen_transkrip' => 'dummy_transkrip.pdf',
                ]
            );
        // d. Simulasi: Verifikasi 15 pengajuan pertama agar bisa dihitung SAW oleh Admin
            if ($i <= 15) {
                \App\Models\Pengajuan::where('mahasiswa_id', $mahasiswa->id)->update([
                    'status' => \App\Models\Pengajuan::STATUS_DIVERIFIKASI,
                    'diverifikasi_at' => now(),
                ]);
            }
        }

        $this->command->info('20 Mahasiswa berhasil dibuat (mhs1@... s.d. mhs20@...) | password: password');

        // ==========================================
        // 4. Data Kriteria SAW
        // ==========================================
        \App\Models\Kriteria::insert([
            ['kode' => 'ipk', 'nama' => 'Indeks Prestasi Kumulatif', 'bobot' => 30, 'jenis' => 'benefit', 'keterangan' => 'Semakin tinggi IPK semakin besar peluang'],
            ['kode' => 'penghasilan', 'nama' => 'Penghasilan Orang Tua', 'bobot' => 30, 'jenis' => 'cost', 'keterangan' => 'Semakin kecil penghasilan, bobot nilai semakin besar'],
            ['kode' => 'prestasi', 'nama' => 'Prestasi Akademik/Non', 'bobot' => 20, 'jenis' => 'benefit', 'keterangan' => 'Akumulasi poin prestasi'],
            ['kode' => 'keaktifan', 'nama' => 'Keaktifan Organisasi', 'bobot' => 20, 'jenis' => 'benefit', 'keterangan' => 'Skor keaktifan kemahasiswaan']
        ]);
        $this->command->info('Data Kriteria berhasil disisipkan.');

        // ==========================================
        // 5. Eksekusi Perhitungan SAW untuk 15 Mahasiswa
        // ==========================================
        app(\App\services\SAWService::class)->hitung();
        $this->command->info('Simulasi Perhitungan SAW untuk 15 mahasiswa berhasil dijalankan.');
    }
}
