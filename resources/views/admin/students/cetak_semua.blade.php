<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Semua Data Pendaftar PPDB</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
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
            left: 20px;
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
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: flex-end;
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
                margin: 0;
                padding: 0;
                width: 100%;
                max-width: none;
            }
            @page {
                size: landscape;
                margin: 10mm;
            }
        }
    </style>
</head>
<body>

    <button class="print-btn" onclick="window.print()"><i class="fas fa-print"></i> Cetak Dokumen Ini</button>

    <div class="container">
        <div class="header">
            <img src="{{ asset('images/tut.png') }}" alt="Logo">
            <h2>PEMERINTAH KABUPATEN/KOTA</h2>
            <h3>DINAS PENDIDIKAN</h3>
            <h2>SDN MEKARLAKSANA</h2>
            <p>Alamat: Jalan Raya Mekarlaksana No. 123, Kec. Contoh, Kab. Contoh</p>
        </div>

        <div class="title">REKAPITULASI HASIL PENDAFTARAN PESERTA DIDIK BARU (PPDB) TAHUN {{ date('Y') }}</div>

        @if(request('search'))
            <p style="font-size: 14px; margin-bottom: 10px;">Filter Pencarian: <strong>{{ request('search') }}</strong></p>
        @endif

        <table>
            <thead>
                <tr>
                    <th width="3%">No</th>
                    <th width="12%">NISN</th>
                    <th width="20%">Nama Lengkap</th>
                    <th width="5%">L/P</th>
                    <th width="15%">Asal Sekolah</th>
                    <th width="10%">Jalur</th>
                    <th width="20%">Nama Orang Tua/Wali</th>
                    <th width="15%">Status Seleksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $index => $student)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td style="text-align: center;">{{ $student->nisn }}</td>
                        <td>{{ strtoupper($student->nama_lengkap) }}</td>
                        <td style="text-align: center;">{{ $student->jenis_kelamin == 'Laki-laki' ? 'L' : 'P' }}</td>
                        <td>{{ $student->nama_sekolah_asal }}</td>
                        <td style="text-align: center;">{{ $student->jalur_pendaftaran }}</td>
                        <td>{{ $student->nama_ayah }} / {{ $student->nama_ibu }}</td>
                        <td style="text-align: center; font-weight: bold;">{{ $student->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 20px;">Belum ada data pendaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer">
            <div class="signature">
                <p>Mekarlaksana, {{ date('d F Y') }}<br>Ketua Panitia PPDB,</p>
                <div class="signature-space"></div>
                <p><strong>( ........................................ )</strong><br>NIP. ........................................</p>
            </div>
        </div>
    </div>

</body>
</html>


