<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Pegawai.pdf</title>
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
            font-size: 20px;
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
    <h1>Daftar Pegawai</h1>
    <table>
        <thead>
            <tr>
                <th>Id Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Email</th>
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
                        <?= $item['nama_pegawai']; ?>
                    </td>
                    <td>
                        <?= $item['email']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>