<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main>
    <div class="container-fluid">
        <h3 class="mt-4">Tambah Barang Keluar</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="/pages/index">Dashboard </a></li>
            <li class="breadcrumb-item "><a href="/admin/brgkeluar/index">Tabel Barang Keluar </a></li>
            <li class="breadcrumb-item active">Tambah Barang Keluar</li>
        </ol>

        <!-- form Transaksi -->
        <form action="/admin/brgkeluar/simpan" method="POST">
            <div class="row mb-4 justify-content-between">
                <div class="col-lg-6">
                    <div class="mb-3 row">
                        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control-plaintext" id="tanggal" name="tanggal" value="<?= $tgl; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="id_brgkeluar" class="col-sm-3 col-form-label">Kode Keluar</label>
                        <div class="col-sm-9">
                            <input type="text" disabeled class="form-control-plaintext id-brgkeluar" id="id_brgkeluar" name="id_brgkeluar" value="<?= $kode; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3 row">
                        <label for="catatan" class="col-sm-3 col-form-label">Catatan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menampilkan Flash Data -->
            <?php if (session()->getFlashdata('gagal')) : ?>
                <div class="alert alert-danger my-3" role="alert">
                    <?= session()->getFlashdata('gagal'); ?>
                </div>
            <?php endif; ?>

            <!-- Tabel Item -->
            <div class="card">
                <div class="card-header py-3 px-1 d-flex flex-row">
                    <div class="col-6">
                        Items Barang Keluar
                    </div>

                    <div class="col-6 text-right">
                        <div class="tambah-data">
                            <button type="button" class="btn btn-sm btn-tambah" data-toggle="modal" data-target="#tambahModel">
                                <i class="fas fa-plus mr-1"></i>
                                Tambah Items
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="50">No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>SubTotal</th>
                                    <th width="100">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($item != 0) {
                                    // i = 1 kode unik agar ketika item dipilih tidak terpilih semua
                                    $i = 1;
                                    foreach ($item as $it) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td> <?= $it['id_barang']; ?></td>
                                            <td> <?= $it['nm_barang']; ?></td>
                                            <td> <?= $it['satuan']; ?></td>
                                            <td>
                                                <input class="form-control tabel-input harga-<?= $i; ?>" type="text" value="<?= $it['harga']; ?>" name="harga_<?= $i; ?>" onkeyup="harga(<?= $i; ?>)" style="width: 120px;">
                                            </td>
                                            <td>
                                                <input class=" form-control tabel-input qty-<?= $i; ?>" type="text" value="1" name="qty_<?= $i; ?>" onkeyup="qty(<?= $i; ?>)" style="width: 50px;">
                                            </td>
                                            <!-- Menampilkan sub total harga -->
                                            <td>
                                                <h6 class="show-subtotal-<?= $i; ?>">Rp <?= number_format($it['harga'], '0', ',', '.'); ?></h6>
                                                <input type="hidden" class="total-harga-<?= $i; ?>" value="<?= $it['harga']; ?>">
                                            </td>
                                            <td><a href="/admin/brgkeluar/deleteCart/<?= $it['id_barang']; ?>" class="btn btn-sm btn-delete"><i class="fa fa-trash mx-1"></i></a></td>
                                        </tr>
                                <?php $i++;
                                    endforeach;
                                } ?>

                            </tbody>
                        </table>
                    </div>

                    <!-- total harga -->
                    <hr>
                    <div class="row">
                        <div class="col">
                            <?php if ($item != 0) : ?>
                                <input type="text" readonly class="form-control-plaintext count-item count-brgkeluar" value="<?= count($item); ?>">
                            <?php endif; ?>
                        </div>
                        <div class=" col-8 text-right">
                            <h5><b>Total</b></h5>
                        </div>
                        <div class="col">
                            <h5 class="show-total-keluar">
                                <b>Rp-</b>
                            </h5>
                            <input type="hidden" class="total-keluar" name="total" value="0">
                        </div>
                    </div>

                </div>
            </div>
            <div class="row my-3">
                <div class="col-8"></div>
                <div class="col">
                    <button type="reset" class="btn btn-block btn-secondary text-white">
                        Reset</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-block btn-primary text-white" data-toggle="modal" data-target="#checkoutModal">
                        Submit</button>
                </div>
            </div>
        </form>
    </div>
</main>

<!-- Modal untuk membuat popup tambah data -->
<div class="modal fade" id="tambahModel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- Tabel barang -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th width="200">Nama Barang</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <!-- <th>qty</th> -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($barang as $br) : ?>
                                <tr>
                                    <td><?= $br['id_barang']; ?></td>
                                    <td><?= $br['nm_barang']; ?></td>
                                    <td><?= $br['satuan']; ?></td>
                                    <td><?= $br['harga']; ?></td>
                                    <td><?= $br['stok']; ?></td>
                                    <td>
                                        <a href="/admin/brgkeluar/addCart/<?= $br['id_barang']; ?>" class="btn btn-sm btn-info"><i class="fa fa-plus-square mr-2"></i>Tambah</a>

                                    </td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>



<?= $this->endSEction(); ?>