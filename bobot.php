<?php
require_once 'conn.php';

$page = "bobot";
$no = 0;
$query = mysqli_query($con, "SELECT * FROM bobot");
$bobot = mysqli_fetch_row($query);

if (mysqli_num_rows($query) > 0) {
    $jumlah = $bobot[0] + $bobot[1] + $bobot[2] + $bobot[3] + $bobot[4];
} else {
    $jumlah = 0;
}

if (isset($_POST['submit'])) {

    $jumlahC = $_POST['C1'] + $_POST['C2'] + $_POST['C3'] + $_POST['C4'] + $_POST['C5'];
    if ($jumlahC > 1) {
        echo "<script> alert('Total Nilai Bobot Harus 1') </script>";
    } else {

        $query = mysqli_query($con, "INSERT INTO bobot (C1, C2, C3, C4, C5)
                                 VALUES
                                 ('$_POST[C1]', '$_POST[C2]', '$_POST[C3]', '$_POST[C4]', '$_POST[C5]')");

        if ($query) {
            header("Location: bobot.php");
        } else {
            echo "<script> alert('GAGAL') </script>";
        }
    }
}

if (isset($_POST['edit'])) {

    $query = mysqli_query($con, "UPDATE bobot SET 
                                 C1 = '$_POST[C1]', C2 = '$_POST[C2]', C3 = '$_POST[C3]', C4 = '$_POST[C4]', 
                                 C5 = '$_POST[C5]'
                                 WHERE C1 = '$_POST[C1]'");

    if ($query) {
        header("Location: bobot.php");
    } else {
        echo "<script> alert('GAGAL') </script>";
    }
}

if (isset($_POST['hapus'])) {

    $query = mysqli_query($con, "DELETE FROM bobot");

    if ($query) {
        header("Location: bobot.php");
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
                                <h5 class="card-title fw-bolder mt-2">Data Bobot</h5>
                                <!-- Button trigger modal -->
                                <?php if (mysqli_num_rows($query) > 0) { ?>
                                    <button type="button" class="btn btn-success" disabled data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                        </svg>
                                    </button>
                                <?php } else { ?>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                                        </svg>
                                    </button>
                                <?php } ?>

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
                                                        <label class="form-label">Absensi</label>
                                                        <input type="number" class="form-control" name="C1" step="any">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Total Alfa</label>
                                                        <input type="number" class="form-control" name="C2" step="any">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Telat</label>
                                                        <input type="number" class="form-control" name="C3" step="any">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Kerapian</label>
                                                        <input type="number" class="form-control" name="C4" step="any">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Tanggung Kawab</label>
                                                        <input type="number" class="form-control" name="C5" step="any">
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
                                        <th class="fw-bolder">Absensi</th>
                                        <th class="fw-bolder">Alfa</th>
                                        <th class="fw-bolder">Telat</th>
                                        <th class="fw-bolder">Kerapian</th>
                                        <th class="fw-bolder">Tanggung Jawab</th>
                                        <th class="fw-bolder">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($query as $data) : ?>
                                        <tr>
                                            <td><?= $data['C1'] ?></td>
                                            <td><?= $data['C2'] ?></td>
                                            <td><?= $data['C3']  ?></td>
                                            <td><?= $data['C4'] ?></td>
                                            <td><?= $data['C5'] ?></td>

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
                                                                <label class="form-label">Absensi</label>
                                                                <input type="number" class="form-control" name="C1" step="any" value="<?= $data['C1'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Total Alfa</label>
                                                                <input type="number" class="form-control" name="C2" step="any" value="<?= $data['C2'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Telat</label>
                                                                <input type="number" class="form-control" name="C3" step="any" value="<?= $data['C3'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kerapian</label>
                                                                <input type="number" class="form-control" name="C4" step="any" value="<?= $data['C4'] ?>">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Tanggung Kawab</label>
                                                                <input type="number" class="form-control" name="C5" step="any" value="<?= $data['C5'] ?>">
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
                                                            Yakin Ingin Hapus Data ?
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
                                    <tr>
                                        <th class="fw-bolder" colspan="2">Total Nilai Bobot</th>
                                        <th colspan="1">:</th>
                                        <th class="fw-bolder text-start" colspan="1"><?= $jumlah ?></th>
                                    </tr>
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