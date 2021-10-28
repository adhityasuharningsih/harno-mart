<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>

<main>
    <div class="container-fluid">
        <h3 class="mt-4">Data Supplier</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="/pages/index">Dashboard </a></li>
            <li class="breadcrumb-item">Data Supplier</li>
        </ol>
        <!-- Tabel -->
        <div class="tambah-data mt-auto">
            <button type="button" class="btn btn-tambah tambah-supplier" data-toggle="modal" data-target="#tambahModel" data-id="<?= $kode; ?>">
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
                <p><?= $validation->getError('nm_supplier'); ?></p>
                <p><?= $validation->getError('alamat'); ?></p>
                <p><?= $validation->getError('no_hp'); ?></p>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header py-3">
                <i class="fas fa-table mr-1"></i>
                Tabel Supplier
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="70px">Kode Supplier</th>
                                <th width="150px">Nama Supplier</th>
                                <th width="250px">Alamat</th>
                                <th>No Telefon</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($supplier as $s) : ?>
                                <tr>
                                    <td><?= $s['id_supplier']; ?></td>
                                    <td><?= $s['nm_supplier']; ?></td>
                                    <td><?= $s['alamat']; ?></td>
                                    <td><?= $s['no_hp']; ?></td>
                                    <td><?= $s['email']; ?></td>
                                    <td>
                                        <button class="btn btn-edit btn-sm edit-supplier" data-toggle="modal" data-target="#tambahModel" data-id="<?= $s['id_supplier']; ?>">
                                            <i class=" fas fa-edit"></i>
                                        </button>

                                        <button class=" btn btn-delete btn-sm hapus-supplier" data-toggle="modal" data-target="#hapusModel" data-id="<?= $s['id_supplier']; ?>" data-nama="<?= $s['nm_supplier']; ?>">
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form input data -->
                <form action="/supplier/simpan" method="POST">
                    <?= csrf_field(); ?>

                    <div class="form-group">
                        <label for="id_supplier"> Kode Supplier : <b class="show-id"> </b></label>
                        <input type="hidden" class="form-control id-supplier" id="id_supplier" name="id_supplier">

                    </div>
                    <div class="form-group">
                        <label for="nm_supplier">Nama Supplier</label>
                        <input type="text" class="form-control nm-supplier" id="nm_supplier" name="nm_supplier">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea type="text" class="form-control alamat-supplier" id="alamat" name="alamat" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Telefon</label>
                        <input type="text" class="form-control no_hp-supplier" id="no_hp" name="no_hp">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control email-supplier" id="email" name="email">
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