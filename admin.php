<?php
require_once 'conn.php';

$page = "admin";
$no = 0;
$query = mysqli_query($con, "SELECT * FROM admin");
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
                                <h5 class="card-title fw-bolder mt-2">Admin</h5>

                            </div>
                            <table class="table table-responsive text-center table-bordered rounded-3">
                                <thead>
                                    <tr>
                                        <th class="fw-bolder">NO</th>
                                        <th class="fw-bolder">Foto</th>
                                        <th class="fw-bolder">Nama</th>
                                        <th class="fw-bolder">Username</th>
                                        <th class="fw-bolder">Password</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($query as $data) : $no++ ?>
                                        <tr>
                                            <th scope="row" class="fw-bolder"><?= $no ?></th>
                                            <td>
                                                <img src="assets/img/avatars/<?= $data['foto'] ?>" alt="" class="rounded-circle" width="85" height="85">
                                            </td>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['user'] ?></td>
                                            <td><?= $data['pass']  ?></td>
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