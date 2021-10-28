<?= $this->extend('layout/templatelaporan'); ?>
<?= $this->section('content'); ?>

<?php
$totalall = array();
foreach ($brgmasuk as $bm) :
    array_push($totalall, $bm['total']);
endforeach; ?>

<main>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- judul dan tanggal -->
                <div class="mb-3 my-0 d-flex flex-row justify-content-between">
                    <div class="col-6">
                        <h6 class="mb-0">Laporan Barang Masuk</h6>
                    </div>
                    <div class="col-6">
                        <h6 class="text-right"><?= $tgl; ?></h6>
                    </div>
                </div>
                <!-- kepala laporan -->
                <div class="mb-4 d-flex flex-row align-items-center justify-content-between">
                    <div class="col-1 ml-3">
                        <img src="/assets/img/logo-warna.png" alt="">
                    </div>
                    <div class="col-11">
                        <h4 class="text-center mb-2"><b>LAPORAN BARANG MASUK</b></h4>
                        <h6 class="text-center"><?= $tglawal; ?> sampai <?= $tglakhir; ?></h6>
                        <h6 class="text-center mt-4">Toko Suharno</h6>
                        <h6 class="text-center">Jl. Desa Mekarsari Rt.03 Rw.03 Duduan, Mekarsari</h6>
                        <!-- <h5 class="text-center">Kutowinangun,Kebumen, Jawa Tengah 54393</h5>
                        <h5 class="text-center">No.telp : 085327033456</h5> -->
                    </div>
                </div>

                <!-- tabel untuk menampilkan isi -->
                <table class=" table  table-striped">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kode Barang Masuk</th>
                        <th>Nama Supplier</th>
                        <th>Subtotal</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($brgmasuk as $bm) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= date('l, d F Y', strtotime($bm['created_at'])) ?></td>
                            <td><?= $bm['id_brgmasuk']; ?></td>
                            <td><?= $bm['id_supplier']; ?></td>
                            <td>Rp <?= number_format($bm['total'], '0', ',', '.'); ?></td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>

                    <!-- Menjumlahkan total semua transaksi -->
                    <tr style="margin-top: 4px;">
                        <th colspan="4" style="text-align: right;">Total</th>
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