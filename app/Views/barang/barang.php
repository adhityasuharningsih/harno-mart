<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<main>
    <div class="container-fluid">
        <h3 class="mt-4">Data Barang</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="/pages/index">Dashboard </a></li>
            <li class="breadcrumb-item">Data Barang</li>
        </ol>
        <!-- Tabel -->
        <div class="tambah-data">
            <button type="button" class="btn btn-tambah tambah-barang" data-toggle="modal" data-target="#tambahModel" data-id=<?= $kode; ?>>
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
                <p><?= $validation->getError('nm_barang'); ?></p>
                <p><?= $validation->getError('satuan'); ?></p>
                <p><?= $validation->getError('harga'); ?></p>
                <p><?= $validation->getError('stok'); ?></p>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="nama-tabel">
                    <i class="fas fa-table mr-1"></i>
                    Data Tabel Barang
                </div>
                <div class="laporan">
                    <a href="/admin/barang/cetaklaporan" class="btn btn-sm btn-laporan">
                        <i class="fas fa-print mr-1"></i>
                        Laporan
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Update</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th style="width: 60px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php $no = 1;
                            foreach ($barang as $br) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= date('l, d F Y', strtotime($br['updated_at'])); ?></td>
                                    <td><?= $br['id_barang']; ?></td>
                                    <td><?= $br['nm_barang']; ?></td>
                                    <td><?= $br['nm_kategori']; ?></td>
                                    <td><?= $br['satuan']; ?></td>
                                    <td>Rp <?= number_format($br['harga'], '0', ',', '.'); ?></td>
                                    <td>
                                        <?php if ($br['stok'] <= 3) : ?>
                                            <div class="cardtext text-center text-white bg-red"><?= $br['stok']; ?></div>
                                        <?php elseif ($br['stok'] >= 10) : ?>
                                            <div class="cardtext text-center text-white bg-yellow"><?= $br['stok']; ?></div>
                                        <?php else : ?>
                                            <div class="cardtext text-center text-white bg-green"><?= $br['stok']; ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-edit btn-sm edit-barang" data-toggle="modal" data-target="#tambahModel" data-id="<?= $br['id_barang']; ?>">
                                            <i class=" fas fa-edit"></i>
                                        </button>

                                        <button class=" btn btn-delete btn-sm hapus-barang" data-toggle="modal" data-target="#hapusModal" data-id="<?= $br['id_barang']; ?>" data-nama="<?= $br['nm_barang']; ?>">
                                            <i class=" fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>

                            <?php $no++;
                            endforeach; ?>
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
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form input data -->
                <form action="/barang/simpan" method="POST">
                    <?= csrf_field(); ?>

                    <div class="form-group">
                        <label for="id_barang"> Kode Barang : <b class="show-id"> </b></label>
                        <input type="hidden" class="form-control id-barang" id="id_barang" name="id_barang">

                    </div>
                    <div class="form-group">
                        <label for="nm_barang">Nama Barang</label>
                        <input type="text" class="form-control nm-barang " id="nm_barang" name="nm_barang">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kategori</label>
                        <select class="form-control kategori-brg" id="exampleFormControlSelect1" name="kategori">
                            <?php foreach ($kategori as $kt) : ?>
                                <option value="<?= $kt['id_kategori']; ?>"><?= $kt['nm_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Satuan</label>
                        <select class="form-control satuan-brg" id="exampleFormControlSelect1" name="satuan">
                            <option value="Bal">Bal</option>
                            <option value="Box">Box</option>
                            <option value="Dus">Dus</option>
                            <option value="Renteng">Renteng</option>
                            <option value="Pack">Pack</option>
                            <option value="Strip">Strip</option>
                            <option value="Slop">Slop</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="text" class="form-control harga-brg " id="harga" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input type="text" class="form-control stok-brg " id="stok" name="stok">
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<!-- manampilkan modal yes not -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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