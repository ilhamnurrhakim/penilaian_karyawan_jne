<?php
require_once 'conn.php';

$file = "laporan.json";
$dataFile = file_get_contents($file);
$dataJson = json_decode($dataFile, true);

$page = "proses";
$no = 0;

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
                                <h5 class="card-title fw-bolder mt-2">Proses Perhitungan Metode SAW</h5>

                            </div>
                            <div class="row p-2">
                                <div class="col-sm-5 shadow p-3 me-3">
                                    <h6 class="fw-bold">Normalisasi</h6>
                                    <table class="table table-responsive text-center table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="fw-bolder">C1</th>
                                                <th class="fw-bolder">C2</th>
                                                <th class="fw-bolder">C3</th>
                                                <th class="fw-bolder">C4</th>
                                                <th class="fw-bolder">C5</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < $jumlahS; $i++) { ?>
                                                <tr>
                                                    <td><?= round($hasilC1[$i], 3) ?></td>
                                                    <td><?= round($hasilC2[$i], 3) ?></td>
                                                    <td><?= round($hasilC3[$i], 3) ?></td>
                                                    <td><?= round($hasilC4[$i], 3) ?></td>
                                                    <td><?= round($hasilC5[$i], 3) ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-6 shadow p-3">
                                    <h6 class="fw-bold">Hasil Perhitungan</h6>
                                    <table class="table table-responsive text-center table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="fw-bolder">Nama</th>
                                                <th class="fw-bolder">Posisi</th>
                                                <th class="fw-bolder">Jabatan</th>
                                                <th class="fw-bolder">Hasil</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for ($i = 0; $i < $jumlahS; $i++) { ?>
                                                <tr>
                                                    <td><?= $nama[$i] ?></td>
                                                    <td><?= $posisi[$i] ?></td>
                                                    <td><?= $jabatan[$i] ?></td>
                                                    <td><?= round($hasilC[$i], 4) ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layout/footer.php' ?>