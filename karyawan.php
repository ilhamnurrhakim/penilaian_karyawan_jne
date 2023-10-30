<?php
require_once 'conn.php';

$page = "karyawan";
$no = 0;
$query = mysqli_query($con, "SELECT * FROM karyawan");

if (isset($_POST['submit'])) {

    $query = mysqli_query($con, "INSERT INTO karyawan (nama, posisi, jabatan, tgljoin, jk)
                                 VALUES
                                 ('$_POST[nama]', '$_POST[posisi]', '$_POST[jabatan]', '$_POST[tgljoin]', 
                                  '$_POST[jk]')");

    if ($query) {
        header("Location: karyawan.php");
    } else {
        echo "<script> alert('GAGAL') </script>";
    }
}

if (isset($_POST['edit'])) {

    $query = mysqli_query($con, "UPDATE karyawan SET 
                                 nama = '$_POST[nama]', posisi = '$_POST[posisi]', jabatan = '$_POST[jabatan]', 
                                 tgljoin = '$_POST[tgljoin]', jk = '$_POST[jk]'
                                 WHERE idkaryawan = '$_POST[idkaryawan]'");

    $queryP = mysqli_query($con, "UPDATE penilaian SET 
                                 nama = '$_POST[nama]'
                                 WHERE idkaryawan = '$_POST[idkaryawan]'");

    $querySP = mysqli_query($con, "UPDATE subnilai SET 
                                 nama = '$_POST[nama]'
                                 WHERE idkaryawan = '$_POST[idkaryawan]'");

    if ($query and $queryP and $querySP) {
        header("Location: karyawan.php");
    } else {
        echo "<script> alert('GAGAL') </script>";
    }
}

if (isset($_POST['hapus'])) {

    $query   = mysqli_query($con, "DELETE FROM karyawan WHERE idkaryawan = '$_POST[idkaryawan]'");
    $queryP  = mysqli_query($con, "DELETE FROM penilaian WHERE idkaryawan = '$_POST[idkaryawan]'");
    $querySP = mysqli_query($con, "DELETE FROM subnilai WHERE idkaryawan = '$_POST[idkaryawan]'");

    if ($query and $queryP and $querySP) {
        header("Location: karyawan.php");
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
                                <h5 class="card-title fw-bolder mt-2">Data Karyawan</h5>
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
                                                        <input type="text" class="form-control" name="nama">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Posisi</label>
                                                        <select class="form-select" name="posisi" aria-label="Default select example">
                                                            <option selected disabled>Pilih</option>
                                                            <option value="Operasional">Operasional</option>
                                                            <option value="Customer Service">Customer Service</option>
                                                            <option value="Accounting">Accounting</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Level Jabatan</label>
                                                        <input type="text" class="form-control" name="jabatan">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Join Bekerja</label>
                                                        <input type="date" class="form-control" name="tgljoin">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Jenis Kelamin</label>
                                                        <select class="form-select" name="jk" aria-label="Default select example">
                                                            <option selected disabled>Pilih</option>
                                                            <option value="Laki-laki">Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
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
                                        <th class="fw-bolder">Posisi</th>
                                        <th class="fw-bolder">Level Jabatan</th>
                                        <th class="fw-bolder">Tgl Join Bekerja</th>
                                        <th class="fw-bolder">Jenis Kelamin</th>
                                        <th class="fw-bolder">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($query as $data) : $no++ ?>
                                        <tr>
                                            <th scope="row" class="fw-bolder"><?= $no ?></th>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['posisi'] ?></td>
                                            <td><?= $data['jabatan']  ?></td>
                                            <td><?= $data['tgljoin'] ?></td>
                                            <td><?= $data['jk'] ?></td>

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
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="mb-3">
                                                                <label class="form-label">Nama</label>
                                                                <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>">
                                                                <input type="hidden" class="form-control" name="idkaryawan" value="<?= $data['idkaryawan'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Posisi</label>
                                                                <select class="form-select" name="posisi" aria-label="Default select example">
                                                                    <option disabled>Pilih</option>
                                                                    <?php if ($data['posisi'] == "Operasional") { ?>
                                                                        <option value="Operasional" selected>Operasional</option>
                                                                        <option value="Customer Service">Customer Service</option>
                                                                        <option value="Accounting">Accounting</option>
                                                                    <?php } else if ($data['posisi'] == "Customer Service") { ?>
                                                                        <option value="Operasional">Operasional</option>
                                                                        <option value="Customer Service" selected>Customer Service</option>
                                                                        <option value="Accounting">Accounting</option>
                                                                    <?php } else if ($data['posisi'] == "Accounting") { ?>
                                                                        <option value="Operasional">Operasional</option>
                                                                        <option value="Customer Service">Customer Service</option>
                                                                        <option value="Accounting" selected>Accounting</option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Level Jabatan</label>
                                                                <input type="text" class="form-control" name="jabatan" value="<?= $data['jabatan'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Join Bekerja</label>
                                                                <input type="date" class="form-control" name="tgljoin" value="<?= $data['tgljoin'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Jenis Kelamin</label>
                                                                <select class="form-select" name="jk" aria-label="Default select example">
                                                                    <option selected disabled>Pilih</option>
                                                                    <?php if ($data['jk'] == "Laki-laki") { ?>
                                                                        <option value="Laki-laki" selected>Laki-laki</option>
                                                                        <option value="Perempuan">Perempuan</option>
                                                                    <?php } else { ?>
                                                                        <option value="Laki-laki">Laki-laki</option>
                                                                        <option value="Perempuan" selected>Perempuan</option>
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