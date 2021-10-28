<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<main>
    <div class="container-fluid">
        <h3 class="mt-4">Data Barang Masuk</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="/pages/index">Dashboard </a></li>
            <li class="breadcrumb-item">Data Barang Masuk</li>
        </ol>
        <!-- Tabel -->
        <div class="tambah-data mt-auto">
            <a href="/admin/brgmasuk/formbarang" class="btn btn-tambah">
                <i class=" fas fa-plus mr-1"></i>
                Tambah Data
            </a>
        </div>

        <!-- menampilkan flash data -->
        <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success my-3" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('gagal')) : ?>
            <div class="alert alert-danger my-3" role="alert">

                <?= session()->getFlashdata('gagal'); ?>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div class="nama-tabel">
                    <i class="fas fa-table mr-1"></i>
                    Data Tabel Barang Masuk
                </div>
                <div class="laporan">
                    <a href="#" class="btn btn-sm btn-laporan" data-toggle="modal" data-target="#modalCetak">
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
                                <th>Tanggal</th>
                                <th>Kode Barang Masuk</th>
                                <th>Nama Supplier</th>
                                <th>Total</th>
                                <th style="width: 80px;">Catatan</th>
                                <th width="50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($supplier as $bm) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= date('l, d F Y', strtotime($bm['created_at'])); ?></td>
                                    <td><?= $bm['id_brgmasuk']; ?></td>
                                    <td><?= $bm['nm_supplier']; ?></td>
                                    <td>Rp <?= number_format($bm['total'], '0', ',', '.'); ?></td>
                                    <td><?= $bm['catatan']; ?></td>
                                    <td>
                                        <button class="btn btn-edit btn-sm detail-pembelian" data-toggle="modal" data-target="#modalDetail" data-id="<?= $bm['id_brgmasuk']; ?>" data-supplier="<?= $bm['nm_supplier']; ?>">
                                            <i class=" fas fa-list"></i>
                                        </button>
                                        <button class=" btn btn-delete btn-sm hapus-masuk" data-toggle="modal" data-target="#modalHapus" data-id="<?= $bm['id_brgmasuk']; ?>">
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


<!-- Modal Detail Pembelian -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="staticBackdrop" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Barang Masuk</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <!-- <h5 class="id-brgmasuk">..</h5> -->
                <div class="d-flex flex-row justify-content-between">
                    <table class="col-6">
                        <tr>
                            <th>Kode Pembelian</th>
                            <td style="width: 50px;" class="text-center">:</td>
                            <td class="id-brgmasuk"></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td style="width: 50px;" class="text-center">:</td>
                            <td class="tgl-pem"></td>
                        </tr>
                        <tr>
                            <th>Nama Supplier</th>
                            <td style="width: 50px;" class="text-center">:</td>
                            <td class="sup-pem">
                            </td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td style="width: 50px;" class="text-center">:</td>
                            <td class="catatan-pem"> - </td>
                        </tr>
                    </table><br>
                    <table class="col-6">
                        <tr>
                            <th>Foto Struk</th>
                            <td style="width: 50px;">:</td>
                            <td>
                                <img src="/assets/img/default.jpg" class="img-thumbnail struk-pem" style="width: 50px;" alt="">
                            </td>
                        </tr>
                    </table>
                </div><br>
                <table class="table table-sm table-striped">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Satuan</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Harga</th>
                            <th scope="col" class="text-right">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody id="show-detail">

                    </tbody>

                    <tfoot>
                        <tr>
                            <th colspan="6" class="text-right">Total </th>
                            <td class="total-pem text-right"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="modal-footer">
                <a href=" " class="btn btn-tosca btn-sm cetak-detail"><i class="fa fa-print"></i></a>
                <a href=" " class="btn btn-edit btn-sm ubah-pem"><i class="fa fa-edit"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- Model Hapus  -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

<!-- Modal Cetak Laporan -->
<div class="modal fade" id="modalCetak" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" id="staticBackdrop" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/admin/brgmasuk/cetaklaporan" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan Barang Masuk</h5>
                </div>
                <div class="modal-body">
                    <?= csrf_field(); ?>
                    <div class="col">
                        <label for="nama" class="col-form-label">Dari Tanggal</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="tgl_awal" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>
                    <div class="col">
                        <label for="nama" class="col-form-label">Sampai Tanggal</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="tgl_akhir" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-print mr-1 "></i>Cetak</button>
                    <button href="/admin/brgmasuk" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSEction(); ?>