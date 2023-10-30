<?php
require_once 'conn.php';

$page = "penilaian";

$no = 0;

$queryK = mysqli_query($con, "SELECT * FROM karyawan");
$queryP = mysqli_query($con, "SELECT * FROM penilaian");

if (isset($_POST['submit'])) {

    $result = $_POST['nama'];
    $result_explode = explode('|', $result);

    $queryP = mysqli_query($con, "INSERT INTO penilaian (idkaryawan, nama, absensi, totalalfa, telat,
                                 kerapian, tanggungjawab)
                                 VALUES
                                 ('$result_explode[1]', '$result_explode[0]', '$_POST[absensi]', '$_POST[totalalfa]', 
                                  '$_POST[telat]', '$_POST[kerapian]', '$_POST[tanggungjawab]')");

    if ($_POST['absensi'] == 26) {
        $nilaiC1 = 90;
    } else if (($_POST['absensi'] >= 24) and ($_POST['absensi'] < 26)) {
        $nilaiC1 = 70;
    } else if (($_POST['absensi'] >= 22) and ($_POST['absensi'] < 24)) {
        $nilaiC1 = 50;
    } else if ($_POST['absensi'] < 22) {
        $nilaiC1 = 20;
    }

    if ($_POST['totalalfa'] == "Hadir Semua") {
        $nilaiC2 = 90;
    } else if ($_POST['totalalfa'] == "1") {
        $nilaiC2 = 85;
    } else if ($_POST['totalalfa'] == "2") {
        $nilaiC2 = 80;
    } else if ($_POST['totalalfa'] == "3") {
        $nilaiC2 = 75;
    } else if ($_POST['totalalfa'] == "4") {
        $nilaiC2 = 70;
    } else if ($_POST['totalalfa'] == "Lebih dari 4") {
        $nilaiC2 = 20;
    }

    if ($_POST['telat'] == 0) {
        $nilaiC3 = 90;
    } else if (($_POST['telat'] > 0) and ($_POST['telat'] <= 3)) {
        $nilaiC3 = 80;
    } else if (($_POST['telat'] > 3) and ($_POST['telat'] <= 6)) {
        $nilaiC3 = 70;
    } else if ($_POST['telat'] > 6) {
        $nilaiC3 = 20;
    }

    if ($_POST['kerapian'] == "Rapi") {
        $nilaiC4 = 90;
    } else if ($_POST['kerapian'] == "Cukup Rapi") {
        $nilaiC4 = 80;
    } else if ($_POST['kerapian'] == "Tidak Rapi") {
        $nilaiC4 = 50;
    }

    if ($_POST['tanggungjawab'] == "Iya") {
        $nilaiC5 = 90;
    } else if ($_POST['kerapian'] == "Tidak") {
        $nilaiC5 = 50;
    }

    $querySP = mysqli_query($con, "INSERT INTO subnilai (idkaryawan, nama, C1, C2, C3, C4, C5)
                                    VALUES
                                    ('$result_explode[1]', '$result_explode[0]', '$nilaiC1', '$nilaiC2', '$nilaiC3', 
                                     '$nilaiC4', '$nilaiC5')");



    if ($queryP and $querySP) {
        header("Location: penilaian.php");
    } else {
        echo "<script> alert('GAGAL') </script>";
    }
}

if (isset($_POST['edit'])) {

    $query = mysqli_query($con, "UPDATE penilaian SET 
                                 absensi = '$_POST[absensi]', totalalfa = '$_POST[totalalfa]', telat = '$_POST[telat]', 
                                 kerapian = '$_POST[kerapian]', tanggungjawab = '$_POST[tanggungjawab]'
                                 WHERE idkaryawan = '$_POST[idkaryawan]'");

    if ($_POST['absensi'] == 26) {
        $nilaiC1 = 90;
    } else if (($_POST['absensi'] >= 24) and ($_POST['absensi'] < 26)) {
        $nilaiC1 = 70;
    } else if (($_POST['absensi'] >= 22) and ($_POST['absensi'] < 24)) {
        $nilaiC1 = 50;
    } else if ($_POST['absensi'] < 22) {
        $nilaiC1 = 20;
    }

    if ($_POST['totalalfa'] == "Hadir Semua") {
        $nilaiC2 = 90;
    } else if ($_POST['totalalfa'] == "1") {
        $nilaiC2 = 85;
    } else if ($_POST['totalalfa'] == "2") {
        $nilaiC2 = 80;
    } else if ($_POST['totalalfa'] == "3") {
        $nilaiC2 = 75;
    } else if ($_POST['totalalfa'] == "4") {
        $nilaiC2 = 70;
    } else if ($_POST['totalalfa'] == "Lebih dari 4") {
        $nilaiC2 = 20;
    }

    if ($_POST['telat'] == 0) {
        $nilaiC3 = 90;
    } else if (($_POST['telat'] > 0) and ($_POST['telat'] <= 3)) {
        $nilaiC3 = 80;
    } else if (($_POST['telat'] > 3) and ($_POST['telat'] <= 6)) {
        $nilaiC3 = 70;
    } else if ($_POST['telat'] > 6) {
        $nilaiC3 = 20;
    }

    if ($_POST['kerapian'] == "Rapi") {
        $nilaiC4 = 90;
    } else if ($_POST['kerapian'] == "Cukup Rapi") {
        $nilaiC4 = 80;
    } else if ($_POST['kerapian'] == "Tidak Rapi") {
        $nilaiC4 = 50;
    }

    if ($_POST['tanggungjawab'] == "Iya") {
        $nilaiC5 = 90;
    } else if ($_POST['kerapian'] == "Tidak") {
        $nilaiC5 = 50;
    }

    $querySP = mysqli_query($con, "UPDATE subnilai SET 
                                   C1 = '$nilaiC1', C2 = '$nilaiC2', C3 = '$nilaiC3', C4 = '$nilaiC4', C5 = '$nilaiC5'
                                   WHERE idkaryawan = '$_POST[idkaryawan]'");

    if ($query and $querySP) {
        header("Location: penilaian.php");
    } else {
        echo "<script> alert('GAGAL') </script>";
    }
}

if (isset($_POST['hapus'])) {

    $query   = mysqli_query($con, "DELETE FROM penilaian WHERE idkaryawan = '$_POST[idkaryawan]'");
    $querySP = mysqli_query($con, "DELETE FROM subnilai WHERE idkaryawan = '$_POST[idkaryawan]'");

    if ($query and $querySP) {
        header("Location: penilaian.php");
    } else {
        echo "<script> alert('GAGAL') </script>";
    }
}
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
                                <h5 class="card-title fw-bolder mt-2">Data Penilaian Karyawan</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                </button>

                                <!-- Tambah -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="" method="post">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3">
                                                        <label class="form-label">Nama</label>
                                                        <select class="form-select" name="nama" aria-label="Default select example">
                                                            <option selected disabled>Pilih</option>
                                                            <?php

                                                            foreach ($queryK as $data) {
                                                                $cek = mysqli_num_rows(mysqli_query($con, "SELECT * FROM penilaian WHERE nama = '$data[nama]'"));

                                                                if ($cek > 0) {
                                                            ?>
                                                                    <option value="" disabled><?= $data['nama'] ?> (Data Sudah Ada)</option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value="<?= $data['nama'] ?>|<?= $data['idkaryawan'] ?>"><?= $data['nama'] ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Absensi (Benefit)</label>
                                                        <input type="number" name="absensi" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Total Alfa (Cost)</label>
                                                        <select class="form-select" name="totalalfa" aria-label="Default select example">
                                                            <option selected disabled>Pilih</option>
                                                            <option value="Hadir Semua">Hadir Semua</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="Lebih dari 4">Lebih dari 4</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Telat (Cost)</label>
                                                        <input type="number" class="form-control" name="telat">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Kerapian (Benefit)</label>
                                                        <select class="form-select" name="kerapian" aria-label="Default select example">
                                                            <option selected disabled>Pilih</option>
                                                            <option value="Rapi">Rapi</option>
                                                            <option value="Cukup Rapi">Cukup Rapi</option>
                                                            <option value="Tidak Rapi">Tidak Rapi</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggung Jawab (Benefit)</label>
                                                        <select class="form-select" name="tanggungjawab" aria-label="Default select example">
                                                            <option selected disabled>Pilih</option>
                                                            <option value="Iya">Iya</option>
                                                            <option value="Tidak">Tidak</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Tambah -->
                            </div>
                            <table class="table table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">NO</th>
                                        <th class="fw-bolder">Nama</th>
                                        <th class="fw-bolder">Absensi</th>
                                        <th class="fw-bolder">Total Alfa</th>
                                        <th class="fw-bolder">Telat</th>
                                        <th class="fw-bolder">Kerapian</th>
                                        <th class="fw-bolder">Tanggung Jawab</th>
                                        <th class="fw-bolder">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($queryP as $data) : $no++ ?>
                                        <tr>
                                            <th scope="row" class="fw-bolder"><?= $no ?></th>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['absensi'] ?> Hadir</td>
                                            <td><?= $data['totalalfa'] ?> Alfa</td>
                                            <td><?= $data['telat'] ?> Telat Masuk</td>
                                            <td><?= $data['kerapian'] ?></td>
                                            <td><?= $data['tanggungjawab'] ?></td>

                                            <td>
                                                <a href="" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $no ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                </a>

                                                <a href="" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $no ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Edit -->
                                        <div class="modal fade" id="editModal<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="post">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label">Nama</label>
                                                                <input type="text" class="form-control" disabled name="nama" value="<?= $data['nama'] ?>">
                                                                <input type="hidden" class="form-control" name="nama" value="<?= $data['nama'] ?>">
                                                                <input type="hidden" class="form-control" name="idkaryawan" value="<?= $data['idkaryawan'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Absensi</label>
                                                                <input type="number" class="form-control" name="absensi" value="<?= $data['absensi'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Alfa</label>
                                                                <select class="form-select" name="totalalfa" aria-label="Default select example">
                                                                    <option disabled>Pilih</option>
                                                                    <?php if ($data['telat'] == "Hadir Semua") { ?>
                                                                        <option value="Hadir Semua" selected>Hadir Semua</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="Lebih dari 4">Lebih dari 4</option>
                                                                    <?php } else if ($data['telat'] == "1") { ?>
                                                                        <option value="Hadir Semua">Hadir Semua</option>
                                                                        <option value="1" selected>1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="Lebih dari 4">Lebih dari 4</option>
                                                                    <?php } else if ($data['telat'] == "2") { ?>
                                                                        <option value="Hadir Semua">Hadir Semua</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2" selected>2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="Lebih dari 4">Lebih dari 4</option>
                                                                    <?php } else if ($data['telat'] == "3") { ?>
                                                                        <option value="Hadir Semua">Hadir Semua</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3" selected>3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="Lebih dari 4">Lebih dari 4</option>
                                                                    <?php } else if ($data['telat'] == "4") { ?>
                                                                        <option value="Hadir Semua">Hadir Semua</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="Lebih dari 4" selected>Lebih dari 4</option>
                                                                    <?php } else { ?>
                                                                        <option value="Hadir Semua">Hadir Semua</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="Lebih dari 4" selected>Lebih dari 4</option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">telat</label>
                                                                <input type="number" class="form-control" name="telat" value="<?= $data['telat'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kerapian</label>
                                                                <select class="form-select" name="kerapian" aria-label="Default select example">
                                                                    <option selected disabled>Pilih</option>
                                                                    <?php if ($data['kerapian'] == "Rapi") { ?>
                                                                        <option value="Rapi" selected>Rapi</option>
                                                                        <option value="Cukup Rapi">Cukup Rapi</option>
                                                                        <option value="Tidak Rapi">Tidak Rapi</option>
                                                                    <?php } else if ($data['kerapian'] == "Cukup Rapi") { ?>
                                                                        <option value="Rapi">Rapi</option>
                                                                        <option value="Cukup Rapi" selected>Cukup Rapi</option>
                                                                        <option value="Tidak Rapi">Tidak Rapi</option>
                                                                    <?php } else { ?>
                                                                        <option value="Rapi">Rapi</option>
                                                                        <option value="Cukup Rapi">Cukup Rapi</option>
                                                                        <option value="Tidak Rapi" selected>Tidak Rapi</option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label class="form-label">Tanggung Jawab</label>
                                                                <select class="form-select" name="tanggungjawab" aria-label="Default select example">
                                                                    <option selected disabled>Pilih</option>
                                                                    <?php if ($data['tanggungjawab'] == "Iya") { ?>
                                                                        <option value="Iya" selected>Iya</option>
                                                                        <option value="Tidak">Tidak</option>
                                                                    <?php } else { ?>
                                                                        <option value="Iya">Iya</option>
                                                                        <option value="Tidak" selected>Tidak</option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="edit" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Edit -->

                                        <!-- Hapus -->
                                        <div class="modal fade" id="hapusModal<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="" method="post">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin Ingin Hapus Data Dengan Nama <?= $data['nama'] ?>
                                                            <input type="hidden" name="idkaryawan" value="<?= $data['idkaryawan'] ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                            <button type="submit" class="btn btn-danger" name="hapus">Yakin</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Hapus -->

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