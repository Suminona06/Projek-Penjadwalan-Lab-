<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <style>
        .border-table {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        }

        .border-table th {
            border: 1 solid #000;
            font-weight: bold;

        }

        .border-table td {
            border: 1 solid #000;
        }
    </style>

</head>

<body>
    <table class="border-table">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Kode Lengkap</th>
                <th scope="col">Nama Pengguna</th>
                <th scope="col">Kata Sandi</th>
                <th scope="col">Email</th>
                <th scope="col">Status</th>
                <th scope="col">No Telp</th>
                <th scope="col">Prodi/Unit</th>
            </tr>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($user as $user): ?>
                <tr class="text-center">
                    <td scope="row-1">
                        <?= $i++; ?>
                    </td>
                    <td>
                        <?= $user['tanggal']; ?>
                    </td>
                    <td>
                        <?= $user['nama']; ?>
                    </td>
                    <td>
                        <?= $user['email']; ?>
                    </td>
                    <td>
                        <?= $user['komentar']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>