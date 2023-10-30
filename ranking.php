<?php
require_once 'conn.php';

$file = "laporan.json";
$dataFile = file_get_contents($file);
$dataJson = json_decode($dataFile, true);

$page = "ranking";
$no = 0;
$Ranking = 0;

// Table Karyawan
$queryK = mysqli_query($con, "SELECT * FROM karyawan");
$dataK  = mysqli_fetch_row($queryK);

// Table Penilaian
$queryP = mysqli_query($con, "SELECT * FROM penilaian");
$dataP  = mysqli_fetch_row($queryP);

// Table Subnilai
$queryS  = mysqli_query($con, "SELECT * FROM subnilai");
$dataS   = mysqli_fetch_array($queryS);
$jumlahS = mysqli_num_rows($queryS);

// Table Bobot
$queryB = mysqli_query($con, "SELECT * FROM bobot");
$dataB  = mysqli_fetch_row($queryB);

foreach ($queryS as $data) {
    $C1[] = $data['C1'];
    $C2[] = $data['C2'];
    $C3[] = $data['C3'];
    $C4[] = $data['C4'];
    $C5[] = $data['C5'];
}

foreach ($queryS as $dataK) {
    $hasilC1[] = 0;
    $hasilC2[] = 0;
    $hasilC3[] = 0;
    $hasilC4[] = 0;
    $hasilC5[] = 0;

    $proseC1[] = $dataK['C1'] / max($C1);
    $proseC2[] = min($C2) / $dataK['C2'];
    $proseC3[] = min($C3) / $dataK['C3'];
    $proseC4[] = $dataK['C4'] / max($C4);
    $proseC5[] = $dataK['C5'] / max($C5);

    $hasilC1 = $proseC1;
    $hasilC2 = $proseC2;
    $hasilC3 = $proseC3;
    $hasilC4 = $proseC4;
    $hasilC5 = $proseC5;
}

for ($x = 0; $x < $jumlahS; $x++) {

    $hasilC[] = round(($hasilC1[$x] * $dataB[0]) + ($hasilC2[$x] * $dataB[1]) + ($hasilC3[$x] * $dataB[2]) +
        ($hasilC4[$x] * $dataB[3]) + ($hasilC5[$x] * $dataB[4]), 5);
}

foreach ($queryK as $data) {

    $nama[]    = $data['nama'];
    $posisi[]  = $data['posisi'];
    $jabatan[] = $data['jabatan'];
}

for ($no = 1; $no <= $jumlahS; $no++) {
    $ranking[] = $no;
}

// JSON
function mymap_arrays()
{
    $args = func_get_args();
    $key = array_shift($args);
    return array_combine($key, $args);
}

for ($r = 0; $r < $jumlahS; $r++) {
    $ree[] = $r;
}

$key = $ree;
$u_key = array_fill(0, count($nama), array(0, 1, 2, 3));
$result = array_combine($key, array_map('mymap_arrays', $u_key, $nama, $posisi, $jabatan, $hasilC));

function aasort(&$arr, $col, $dir)
{

    $sort_col = array();
    foreach ($arr as $key => $row) {
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
}
aasort($result, 3, SORT_DESC);
$json = json_encode(array('data' => $result));
file_put_contents("laporan.json", $json);
?>

<?php require_once 'layout/sidebar.php' ?>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card shadow-lg">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title fw-bolder mt-2">Hasil Perankingan Karyawan Terbaik Pada JNE Cabang Padang Menggunakan Metode SAW</h5>
                                <a href="cetak.php" class="btn btn-success" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
                                    </svg>
                                    Cetak
                                </a>
                            </div>
                            <table class="table table-responsive text-center mt-4 table-bordered">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">Ranking</th>
                                        <th class="fw-bolder">Nama</th>
                                        <th class="fw-bolder">Posisi</th>
                                        <th class="fw-bolder">Jabatan</th>
                                        <th class="fw-bolder">Total Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataJson['data'] as $data) : $Ranking++ ?>
                                        <tr>
                                            <th class="fw-bolder"><?= $Ranking ?></th>
                                            <td><?= $data[0] ?></td>
                                            <td><?= $data[1] ?></td>
                                            <td><?= $data[2]  ?></td>
                                            <td><?= $data[3] ?></td>
                                        </tr>

                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layout/footer.php' ?>