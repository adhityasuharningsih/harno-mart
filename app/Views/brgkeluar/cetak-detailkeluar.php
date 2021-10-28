<?= $this->extend('layout/templatelaporan'); ?>
<?= $this->section('content'); ?>

<?php
$totalall = array();
foreach ($item as $it) :
    array_push($totalall, $it['total']);
endforeach; ?>

<main>
    <div class="container">
        <div class="card-sm">
            <div class="card-body">
                <!-- judul dan tanggal -->
                <div class="mb-3 mt-5 d-flex flex-row justify-content-between">
                    <div class="col-7">
                        <h6><?= $brgkeluar['id_brgkeluar']; ?></h6>
                    </div>
                    <div class="col">
                        <h6 class="text-right"><?= $tgl; ?></h6>
                    </div>
                </div>
                <!-- kepala laporan -->
                <div class="mb-4 d-flex flex-row align-items-center justify-content-between">
                    <div class="col-1 ml-3">
                        <img src="/assets/img/logo-warna.png" alt="">
                    </div>
                    <div class="col-11">
                        <h4 class="text-center"><b>Transaksi Barang Keluar</b></h4>
                        <h5 class="text-center mt-2">Toko Suharno</h5>
                        <h6 class="text-center">Jl. Desa Mekarsari Rt.03 Rw.03 Duduan, Mekarsari,</h6>
                        <h6 class="text-center">JKutowinangun,Kebumen, Jawa Tengah 54393</h6>
                        <h6 class="text-center">No.telp : 085327033456</h6>
                    </div>
                </div>

                <div class="mt-5 mb-3 d-flex flex-row align-items-center justify-content-between">
                    <table class="col-6">
                        <tr>
                            <th>Kode barang keluar</th>
                            <td>:</td>
                            <td><?= $brgkeluar['id_brgkeluar']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>:</td>
                            <td><?= date('l, d F Y H:i', strtotime($brgkeluar['created_at'])); ?></td>
                        </tr>
                    </table><br>
                    <table class="col-6">
                        <tr>
                            <th>Catatan</th>
                            <td>:</td>
                            <td><?= $brgkeluar['catatan']; ?></td>
                        </tr>
                    </table>
                </div><br>

                <!-- tabel untuk menampilkan isi -->
                <table class="table  table-striped ">
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                        <th style="width: 110;">Harga</th>
                        <th>Subtotal</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($item as $it) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $it['id_barang']; ?></td>
                            <td><?= $it['nm_barang']; ?></td>
                            <td><?= $it['satuan']; ?></td>
                            <td><?= $it['qty']; ?></td>
                            <td>Rp <?= number_format($it['harga'], '0', ',', '.'); ?></td>
                            <td>Rp <?= number_format($it['total'] * $it['qty'], '0', ',', '.'); ?></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>

                    <!-- Menjumlahkan total semua transaksi -->
                    <tr style="margin-top: 4px;">
                        <th colspan="6" style="text-align: right;">Total</th>
                        <th>Rp <?= number_format(array_sum($totalall), '0', ', ', '.'); ?></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    window.print();
</script>

<?= $this->endSection(); ?>