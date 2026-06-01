<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penerima Beasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop-surat h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }
        .kop-surat h2 {
            margin: 5px 0 0;
            font-size: 18px;
        }
        .kop-surat p {
            margin: 5px 0 0;
            font-size: 12px;
        }
        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background-color: #f2f2f2;
            padding: 8px;
            text-align: center;
        }
        td {
            padding: 8px;
        }
        .text-center { text-align: center; }
        .footer {
            margin-top: 40px;
            text-align: right;
            width: 300px;
            float: right;
        }
        .footer p { margin: 5px 0; }
        .ttd {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="kop-surat">
        <h1>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h1>
        <h2>UNIVERSITAS SCHOLARIS</h2>
        <p>Jl. Pendidikan No. 123, Kota Ilmu, Provinsi Pengetahuan 12345</p>
        <p>Website: www.scholaris.ac.id | Email: info@scholaris.ac.id</p>
    </div>

    <div class="title">
        SURAT KEPUTUSAN PENERIMA BEASISWA
    </div>

    <p>Berdasarkan hasil seleksi menggunakan metode <em>Simple Additive Weighting</em> (SAW) pada tanggal {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}, berikut adalah daftar mahasiswa yang dinyatakan <strong>LULUS</strong> dan berhak menerima beasiswa:</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Program Studi</th>
                <th>Angkatan</th>
                <th>Skor Akhir (SAW)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penerima as $index => $pengajuan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $pengajuan->mahasiswa->user->name ?? 'Unknown' }}</td>
                    <td class="text-center">{{ $pengajuan->mahasiswa->nim }}</td>
                    <td>{{ $pengajuan->mahasiswa->prodi }}</td>
                    <td class="text-center">{{ $pengajuan->mahasiswa->angkatan }}</td>
                    <td class="text-center">{{ number_format($pengajuan->skor_saw, 3) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Kota Ilmu, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <p>Pimpinan Universitas / Fakultas,</p>
        <br><br><br>
        <p class="ttd">Prof. Dr. Budi Santoso, M.Kom</p>
        <p>NIP. 19800101 200501 1 001</p>
    </div>

</body>
</html>
