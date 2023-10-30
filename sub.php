<?php
require_once 'conn.php';

$page = "sub";
$no = 0;
$query = mysqli_query($con, "SELECT * FROM subnilai");
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
                                <h5 class="card-title fw-bolder mt-2">Sub-kriteria Penilaian</h5>

                            </div>
                            <table class="table table-responsive text-center">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">NO</th>
                                        <th class="fw-bolder">Nama</th>
                                        <th class="fw-bolder">Absensi</th>
                                        <th class="fw-bolder">Alfa</th>
                                        <th class="fw-bolder">Telat</th>
                                        <th class="fw-bolder">Kerapian</th>
                                        <th class="fw-bolder">Tanggung Jawab</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($query as $data) : $no++ ?>
                                        <tr>
                                            <th scope="row" class="fw-bolder"><?= $no ?></th>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['C1'] ?></td>
                                            <td><?= $data['C2']  ?></td>
                                            <td><?= $data['C3'] ?></td>
                                            <td><?= $data['C4'] ?></td>
                                            <td><?= $data['C5'] ?></td>
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