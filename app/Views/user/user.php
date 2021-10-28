<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<main>
    <div class="container-fluid">
        <h3 class="mt-4">Data Pengguna</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="/pages/index">Dashboard </a></li>
            <li class="breadcrumb-item">Data Pengguna</li>
        </ol>
        <!-- Tabel -->
        <div class="tambah-data mt-auto">
            <button type="button" class="btn btn-tambah tambah-user" data-toggle="modal" data-target="#tambahModel" data-id="<?= $kode; ?>">
                <i class="fas fa-plus mr-1"></i>
                Tambah Data
            </button>
        </div>


        <!-- menampilkan flash data -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success my-3" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('validation')) : ?>
            <div class="alert alert-danger my-3" role="alert">
                <p><?= $validation->getError('nama'); ?></p>
                <p><?= $validation->getError('alamat'); ?></p>
                <p><?= $validation->getError('no_hp'); ?></p>
                <p><?= $validation->getError('username'); ?></p>
                <p><?= $validation->getError('password'); ?></p>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header py-3">
                <i class="fas fa-table mr-1"></i>
                Tabel Pengguna
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="70px">Kode Pengguna</th>
                                <th>Nama Pengguna</th>
                                <th>Alamat</th>
                                <th>No Telefon</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Level</th>
                                <th style="width: 60px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user as $us) : ?>
                                <tr>
                                    <td><?= $us['id_user']; ?></td>
                                    <td><?= $us['nama']; ?></td>
                                    <td><?= $us['alamat']; ?></td>
                                    <td><?= $us['no_hp']; ?></td>
                                    <td><?= $us['username']; ?></td>
                                    <td><?= $us['password']; ?></td>
                                    <td><?= $us['level']; ?></td>
                                    <td>
                                        <button class="btn btn-edit btn-sm edit-user" data-toggle="modal" data-target="#tambahModel" data-id="<?= $us['id_user']; ?>">
                                            <i class=" fas fa-edit"></i>
                                        </button>

                                        <button class=" btn btn-delete btn-sm hapus-user" data-toggle="modal" data-target="#hapusModel" data-id="<?= $us['id_user']; ?>" data-nama="<?= $us['nama']; ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal untuk membuat popup tambah data -->
<div class="modal fade" id="tambahModel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form input data -->
                <form action="/user/simpan" method="POST">
                    <?= csrf_field(); ?>

                    <div class="form-group">
                        <label for="id_user"> Kode Pengguna : <b class="show-id"> </b></label>
                        <input type="hidden" class="form-control id-user" id="id_user" name="id_user">

                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Pengguna</label>
                        <input type="text" class="form-control nm-user" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control alamat-user" id="alamat" name="alamat" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Telefon</label>
                        <input type="text" class="form-control no_hp-user" id="no_hp" name="no_hp">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control username-user" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control password-user" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Level</label>
                        <select class="form-control level-user" id="exampleFormControlSelect1" name="level">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-submit">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<!-- manampilkan modal yes not -->
<div class="modal fade" id="hapusModel" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="_method" value="delete">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                            <div class="col-md-2 ml-auto">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>