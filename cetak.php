<?php
$file = "laporan.json";
$dataFile = file_get_contents($file);
$dataJson = json_decode($dataFile, true);

$no = 0;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/JNE logo SM.png" />
    <title>JNE Express</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-5">Laporan Perhitungan Karyawan Terbaik Pada JNE Express Padang Menggunakan Metode SAW</h2>
        <div class="row justify-content-center text-center">
            <div class="col-10">
                <table class="table table-bordered mt-4">
                    <thead>
                        <th>Ranking</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Jabatan</th>
                        <th>Total Nilai</th>
                    </thead>
                    <tbody>
                        <?php foreach ($dataJson['data'] as $data) : $no++ ?>
                            <tr>
                                <th class="fw-bolder"><?= $no ?></th>
                                <td><?= $data[0] ?></td>
                                <td><?= $data[1] ?></td>
                                <td><?= $data[2] ?></td>
                                <td class="fw-bolder"><?= $data[3] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        window.print()
    </script>
</body>

</html>