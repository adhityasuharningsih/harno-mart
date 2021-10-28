<?= $this->extend('layout/template'); ?>


<!-- Content -->
<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h3 class="mt-4">Kategori Barang</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="/pages/index">Dashboard </a></li>
            <li class="breadcrumb-item">Kategori Barang</li>
        </ol>
        <!-- Tabel -->
        <div class="tambah-data mt-auto">
            <button type="button" class="btn btn-tambah tambah-kategori" data-toggle="modal" data-target="#tambahModel" data-id="<?= $kode; ?>">
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
                <?= $validation->getError('nm_kategori'); ?>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header py-3">
                <i class="fas fa-table mr-1"></i>
                Data Tabel Kategori Barang
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Kategori</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($kategori as $k) : ?>
                                <tr>
                                    <td><?= $k['id_kategori']; ?></td>
                                    <td><?= $k['nm_kategori']; ?></td>
                                    <td>
                                        <button class="btn btn-edit btn-sm edit-kategori" data-toggle="modal" data-target="#tambahModel" data-id="<?= $k['id_kategori']; ?>">
                                            <i class=" fas fa-edit"></i>
                                        </button>

                                        <button class=" btn btn-delete btn-sm hapus-kategori" data-toggle="modal" data-target="#hapusModel" data-id="<?= $k['id_kategori']; ?>" data-nama="<?= $k['nm_kategori']; ?>">
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
                <form action="/kategori/simpan" method="POST">
                    <?= csrf_field(); ?>

                    <div class="form-group">
                        <label for="id_kategori"> Kode Kategori : <b class="show-id"> </b></label>
                        <input type="hidden" class="form-control id-kategori" id="id_kategori" name="id_kategori">

                    </div>
                    <div class="form-group">
                        <label for="nm_kategori">Nama Kategori</label>
                        <input type="text" class="form-control nm-kategori" id="nm_kategori" name="nm_kategori">
                        <!-- menampilkan pesan error -->
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