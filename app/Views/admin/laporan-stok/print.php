<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        @page {
            size: A4;
            margin: 1cm;
        }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 11pt; 
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .header { 
            display: flex;
            align-items: center;
            border-bottom: 3px double #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .logo {
            width: 80px;
            height: 80px;
            margin-right: 20px;
        }
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 50%;
        }
        .header-text {
            flex-grow: 1;
        }
        .header-text h1 {
            margin: 0;
            font-size: 18pt;
            color: #D35400;
            text-transform: uppercase;
        }
        .header-text p {
            margin: 5px 0 0;
            font-size: 10pt;
            color: #666;
        }
        .report-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .report-title h2 {
            margin: 0;
            font-size: 14pt;
            text-decoration: underline;
        }
        .report-title p {
            margin: 5px 0 0;
            font-size: 11pt;
            font-weight: bold;
        }
        .table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
            background-color: #fff;
        }
        .table th, .table td { 
            border: 1px solid #333; 
            padding: 10px 8px; 
        }
        .table th { 
            background-color: #f8f9fa; 
            text-transform: uppercase;
            font-size: 9pt;
            font-weight: bold;
        }
        .table tr:nth-child(even) {
            background-color: #fcfcfc;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-bold { font-weight: bold; }
        
        .badge { 
            padding: 4px 8px; 
            border-radius: 4px; 
            font-size: 8pt; 
            font-weight: bold;
            display: inline-block;
            border: 1px solid transparent;
        }
        .bg-success { background-color: #e6ffed; border-color: #b7eb8f; color: #52c41a; }
        .bg-warning { background-color: #fffbe6; border-color: #ffe58f; color: #faad14; }
        .bg-danger { background-color: #fff1f0; border-color: #ffa39e; color: #f5222d; }
        
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: flex-end;
        }
        .signature {
            text-align: center;
            width: 200px;
        }
        .signature p {
            margin: 0;
        }
        .signature .space {
            height: 70px;
        }
        .signature .name {
            font-weight: bold;
            text-decoration: underline;
        }

        @media print {
            .no-print { display: none; }
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<?php include(APPPATH . 'Views/admin/layout/fungsi.php'); ?>
<body onload="window.print()">
    <div class="header">
        <div class="logo">
            <img src="<?= base_url() ?>/adminlte/adminlte_dist/img/RotiBuled.jpg" alt="Logo Roti Buled">
        </div>
        <div class="header-text">
            <h1>ROTI BULED</h1>
            <p>Coffee & Bread</p>
            <p>Jl. Jend. Sudirman, Awirarangan, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat | Telp: 087720307410</p>
        </div>
    </div>

    <div class="report-title">
        <h2>LAPORAN STOK BAHAN BAKU</h2>
        <p>Periode: <?= $tgl_mulai == $tgl_akhir ? tanggal($tgl_mulai) : tanggal($tgl_mulai) . ' s/d ' . tanggal($tgl_akhir) ?></p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Nama Barang</th>
                <th style="width: 80px;">Stok Awal</th>
                <th style="width: 60px;">Masuk</th>
                <th style="width: 60px;">Keluar</th>
                <th style="width: 80px;">Stok Akhir</th>
                <th style="width: 80px;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($list)) : $i = 1; $currentKategori = ''; ?>
                <?php foreach ($list as $row) : ?>
                    <?php if ($currentKategori != $row['item']['kategori']) : $currentKategori = $row['item']['kategori']; ?>
                        <tr style="background-color: #f2f2f2;">
                            <td colspan="7" style="padding: 8px 10px; font-weight: bold; border-top: 2px solid #333;">
                                KATEGORI: <?= strtoupper($currentKategori) ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="text-center"><?= $i++ ?></td>
                        <td class="text-bold"><?= $row['item']['nama_barang'] ?></td>
                        <td class="text-center"><?= number_format($row['stok_awal'], 0, ',', '.') ?></td>
                        <td class="text-center"><?= number_format($row['masuk'], 0, ',', '.') ?></td>
                        <td class="text-center"><?= number_format($row['keluar'], 0, ',', '.') ?></td>
                        <td class="text-center text-bold"><?= number_format($row['stok'], 0, ',', '.') ?></td>
                        <td class="text-center">
                            <?php if ($row['status'] == 'kosong') : ?>
                                <span class="badge bg-danger">KOSONG</span>
                            <?php elseif ($row['status'] == 'kurang') : ?>
                                <span class="badge bg-warning">KURANG</span>
                            <?php else : ?>
                                <span class="badge bg-success">CUKUP</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data untuk periode ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">
            <p>Dicetak pada: <?= date('d/m/Y H:i') ?></p>
            <p>Penanggung Jawab,</p>
            <div class="space"></div>
            <p class="name">( <?= session()->get('name') ?? 'Admin Stok' ?> )</p>
        </div>
    </div>
</body>
</html>
