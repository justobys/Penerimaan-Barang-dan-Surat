<!DOCTYPE html>
<html lang="en">

<head>
    <title>Export Data Registrasi.pdf</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        thead {
            background-color: yellow;
            text-align: center;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        th,
        td {
            padding: 8px;
            /* border-bottom: 1px solid #ddd; */
            border: 1px solid black;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .badge-success {
            color: #fff;
            background-color: #28a745;
        }

        .badge-danger {
            color: #fff;
            background-color: #dc3545;
        }
    </style>
</head>

<body>
    <h1>Daftar Penerimaan Barang</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No. Resi</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Foto Barang</th>
                <th>Penerima</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            <?php $i = 1; ?>
            <?php foreach ($data as $item): ?>
                <tr>
                    <td>
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $item['tanggal']; ?>
                    </td>
                    <td>
                        <?= $item['no_resi']; ?>
                    </td>
                    <td>
                        <?= $item['nama_barang']; ?>
                    </td>
                    <td>
                        <?= $item['deskripsi']; ?>
                    </td>
                    <td>
                        <?php if (!empty($item['foto_barang'])): ?>
                            <img src="data:image/png;base64,<?= base64_encode(file_get_contents($item['foto_barang'])) ?>"
                                alt="Foto Barang" width="150" height="100"
                                onerror="this.src='<?= base_url('path/to/transparent-image.png') ?>'; this.alt='Image Not Found';">
                        <?php else: ?>
                            <div class="image-not-found">Image Not Found</div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?= $item['nama_pegawai']; ?>
                    </td>
                    <td>
                        <?php
                        $badgeClass = ($item['status'] == 'Diterima') ? 'badge-success' : 'badge-danger';
                        echo '<span class="badge ' . $badgeClass . '">' . $item['status'] . '</span>';
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</body>

</html>