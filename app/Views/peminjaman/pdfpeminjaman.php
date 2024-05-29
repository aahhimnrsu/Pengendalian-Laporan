<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUKTI PEMINJAMAN</title>
    <style>
        hr {
            background-color: white;
            margin: 0 0 45px 0;
            max-width: 100%;
            border-width: 0;
        }

        hr {
            height: 5px;
            border-top: 1px solid black;
            border-bottom: 2px solid black;
        }
    </style>
</head>

<body style="font-size: 12px;">
    <img src="<?= base_url('assets/img/kop.png') ?>" alt="" width="110%">
    <hr>
    <h2 style="text-align: center;">BUKTI PEMINJAMAN</h2>
    <table>
        <tr>
            <?php foreach ($datalaporan as $laporan) { ?>
                <td>Nama</td>
                <td><b>: <?= $laporan->nama_peminjam ?></b></td>
            <?php } ?>
        </tr>
    </table>
    <div style="display: flex; justify-content: center;">
        <table border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 5px; text-align:center">
            <thead>
                <tr bgcolor=silver align=center>
                    <th>No</th>
                    <th>ID Peminjam</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($datalaporan as $laporan) { ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $laporan->id_peminjam ?></td>
                        <td><?= $laporan->nama_barang ?></td>
                        <td><?= $laporan->jumlah ?></td>
                        <td><?= $laporan->tanggal_peminjaman ?></td>
                        <td><?= $laporan->tanggal_pengembalian ?></td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>

    <div style="margin-left: 80%; margin-top: 40%;">
        Palembang, <?= date('d-m-Y'); ?><br>
        Menyetujui,<br>
        Pimpinan QM-HCRu III
        <br><br><br><br><br>
        <b>___________________</b>
    </div>
</body>

</html>