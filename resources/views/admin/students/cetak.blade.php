<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Bukti Pendaftaran - {{ $student->nama_lengkap }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
        }
        .container {
            width: 800px;
            margin: 20px auto;
            padding: 40px;
            border: 1px solid #ccc;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 30px;
            position: relative;
        }
        .header img {
            position: absolute;
            left: 0;
            top: 0;
            width: 80px;
        }
        .header h2 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
        }
        .header h3 {
            margin: 5px 0;
            font-size: 18px;
        }
        .header p {
            margin: 0;
            font-size: 14px;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table td {
            padding: 8px;
            vertical-align: top;
            font-size: 14px;
        }
        .label {
            width: 30%;
            font-weight: bold;
        }
        .colon {
            width: 5%;
            text-align: center;
        }
        .value {
            width: 65%;
        }
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            text-align: center;
            width: 250px;
        }
        .signature-space {
            height: 80px;
        }
        .print-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        @media print {
            .print-btn {
                display: none;
            }
            .container {
                border: none;
                margin: 0;
                padding: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <button class="print-btn" onclick="window.print()"><i class="fas fa-print"></i> Cetak Halaman Ini</button>

    <div class="container">
        <div class="header">
            <img src="{{ asset('images/tut.png') }}" alt="Logo">
            <h2>PEMERINTAH KABUPATEN/KOTA</h2>
            <h3>DINAS PENDIDIKAN</h3>
            <h2>{{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}</h2>
            <p>Alamat: {{ \App\Models\Setting::get('school_address', 'Jl. Alamat Sekolah No. 123') }}</p>
        </div>

        <div class="title">BUKTI PENDAFTARAN PESERTA DIDIK BARU (PPDB)</div>

        <p>Berdasarkan data yang masuk ke dalam sistem PPDB {{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}, menyatakan bahwa:</p>

        <table>
            <tr><td class="label">Nomor Pendaftaran</td><td class="colon">:</td><td class="value"><strong>PPDB-{{ date('Y') }}-{{ str_pad($student->id, 4, '0', STR_PAD_LEFT) }}</strong></td></tr>
            <tr><td class="label">Tanggal Daftar</td><td class="colon">:</td><td class="value">{{ $student->created_at->format('d F Y') }}</td></tr>
            <tr><td class="label">Jalur Pendaftaran</td><td class="colon">:</td><td class="value"><strong>{{ $student->jalur_pendaftaran }}</strong></td></tr>
            
            <tr><td colspan="3"><hr style="border-top: 1px dashed #ccc;"></td></tr>

            <tr><td class="label">NISN</td><td class="colon">:</td><td class="value">{{ $student->nisn }}</td></tr>
            <tr><td class="label">Nama Lengkap</td><td class="colon">:</td><td class="value"><strong>{{ strtoupper($student->nama_lengkap) }}</strong></td></tr>
            <tr><td class="label">Jenis Kelamin</td><td class="colon">:</td><td class="value">{{ $student->jenis_kelamin }}</td></tr>
            <tr><td class="label">Tempat, Tanggal Lahir</td><td class="colon">:</td><td class="value">{{ $student->tempat_lahir }}, {{ \Carbon\Carbon::parse($student->tanggal_lahir)->format('d F Y') }}</td></tr>
            <tr><td class="label">Asal Sekolah</td><td class="colon">:</td><td class="value">{{ $student->nama_sekolah_asal }}</td></tr>
            <tr><td class="label">Nama Orang Tua/Wali</td><td class="colon">:</td><td class="value">{{ $student->nama_ayah }} / {{ $student->nama_ibu }}</td></tr>
            <tr><td class="label">Status Saat Ini</td><td class="colon">:</td><td class="value"><strong>{{ $student->status }}</strong></td></tr>
        </table>

        <p style="font-size: 14px; text-align: justify; margin-top: 20px;">
            Demikian bukti pendaftaran ini dibuat sebagai tanda bahwa calon peserta didik telah terdaftar dalam sistem PPDB {{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}. Harap simpan bukti ini dan bawa pada saat pengumuman atau proses daftar ulang (jika dinyatakan diterima).
        </p>

        <div class="footer">
            <div class="signature">
                <p>Orang Tua / Wali Calon Siswa</p>
                <div class="signature-space"></div>
                <p>( ........................................ )</p>
            </div>
            <div class="signature">
                <p>{{ \App\Models\Setting::get('school_name', 'Nama Sekolah') }}, {{ date('d F Y') }}<br>Panitia PPDB,</p>
                <div class="signature-space"></div>
                <p>( ........................................ )</p>
            </div>
        </div>
    </div>

</body>
</html>


