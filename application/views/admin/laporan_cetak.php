<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pengaduan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cambria', 'Times New Roman', Times, serif;
            color: #000;
            background: white;
            line-height: 1.4;
        }

        .container {
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            padding: 1cm;
            background: white;
            position: relative;
        }

        /* ===== KOP SURAT ===== */
        .kop-surat {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
            position: relative;
        }

        .logo {
            width: 70px;
            height: 70px;
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            width: 100%;
            height: auto;
        }

        .kop-text {
            text-align: center;
            flex: 1;
        }

        .kop-text h4 {
            font-size: 11px;
            font-weight: normal;
            margin-bottom: 2px;
            letter-spacing: 1px;
        }

        .kop-text h2 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .kop-text h3 {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 3px;
            color: #c41e3a;
        }

        .kop-text p {
            font-size: 11px;
            margin-bottom: 2px;
        }

        /* ===== JUDUL LAPORAN ===== */
        .report-title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-top: 15px;
            letter-spacing: 1px;
        }

        .report-subtitle {
            text-align: center;
            font-size: 12px;
            margin-bottom: 15px;
            color: #555;
        }

        /* ===== TABEL ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 11px;
        }

        th {
            background-color: #2c3e50;
            color: white;
            padding: 10px;
            text-align: center;
            border: 1px solid #000;
            font-weight: bold;
        }

        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        td:first-child {
            text-align: center;
            width: 30px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* ===== TANDA TANGAN ===== */
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            padding-top: 20px;
        }

        .signature-box {
            width: 45%;
            text-align: center;
        }

        .signature-box.left {
            text-align: left;
        }

        .signature-box.right {
            text-align: right;
        }

        .signature-date {
            font-size: 11px;
            margin-bottom: 50px;
        }

        .signature-title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 70px;
        }

        .signature-name {
            font-size: 11px;
            text-decoration: underline;
            margin-bottom: 3px;
        }

        .signature-nip {
            font-size: 10px;
            color: #555;
        }

        /* ===== PRINT STYLES ===== */
        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }

            .container {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0.5cm;
                page-break-after: avoid;
            }

            .no-print {
                display: none !important;
            }

            table {
                page-break-inside: avoid;
            }
        }

        @page {
            size: A4;
            margin: 0.5cm;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- KOP SURAT -->
        <div class="kop-surat">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo.webp') ?>" alt="Logo SMK TRIADU">
            </div>
            <div class="kop-text">
                <h4>YAYASAN PENDIDIKAN TRIADI TEKNOLOGI</h4>
                <h2>SMK TRIADU INFORMATIKA</h2>
                <h3>"Terakreditasi A" SMK IT MODERN</h3>
                <p>Jl. Bhayangkara No. 484 Telp. (061) 6635991 (Hunting) Fax. (061) 6641576</p>
                <p>E-mail : smktritech10@gmail.com | Website : www.smktritechinformatika.sch.id</p>
            </div>
        </div>

        <!-- JUDUL LAPORAN -->
        <div class="report-title">
            LAPORAN PENGADUAN SARANA DAN PRASARANA
        </div>

        <div class="report-subtitle">
            Periode: <?php
                        $start = isset($start_date) && !empty($start_date) ? date('d F Y', strtotime($start_date)) : 'Awal';
                        $end = isset($end_date) && !empty($end_date) ? date('d F Y', strtotime($end_date)) : 'Akhir';
                        echo "$start - $end";
                        ?>
        </div>


        <!-- TABEL DATA -->
        <table>
            <thead>
                <tr>
                    <th style="width: 30px;">No.</th>
                    <th>NIS</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($aspirasi)): ?>
                    <?php $no = 1;
                    foreach ($aspirasi as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($item->nis) ?></td>
                            <td><?= htmlspecialchars($item->nama_kategori ?? '-') ?></td>
                            <td><?= htmlspecialchars($item->lokasi) ?></td>
                            <td><?= htmlspecialchars($item->keterangan) ?></td>
                            <td>
                                <?php
                                $status = $item->status;
                                $badge_class = '';
                                if ($status == 'Menunggu') $badge_class = 'warning';
                                elseif ($status == 'Proses') $badge_class = 'info';
                                elseif ($status == 'Selesai') $badge_class = 'success';
                                echo htmlspecialchars($status);
                                ?>
                            </td>
                            <td><?= date('d-m-Y', strtotime($item->tanggal)) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; font-style: italic;">Tidak ada data untuk periode ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- TANDA TANGAN -->
        <div class="signature-section">
            <div class="signature-box left">
                <div class="signature-date">
                    Medan, <?= date('d F Y') ?>
                </div>
            </div>
            <div class="signature-box right">
                <div class="signature-title">Kepala Sekolah,</div>
                <div class="signature-name">
                    <br><br>
                </div>
                <div class="signature-name">( _____________________________ )</div>
                <div class="signature-nip">NIP. ................................</div>
            </div>
        </div>
    </div>

    <script>
        // Otomatis cetak saat halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>