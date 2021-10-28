<?= $this->extend('layout/templatelaporan'); ?>
<?= $this->section('content'); ?>

<main>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- judul dan tanggal -->
                <div class="mb-3 my-0 d-flex flex-row justify-content-between">
                    <div class="col-6">
                        <h6>Laporan Stok Barang</h6>
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
                        <h4 class="text-center"><b>Laporan Stok Barang</b></h4>
                        <h4 class="text-center mt-5">Toko Suharno</h4>
                        <h5 class="text-center">Jl. Desa Mekarsari Rt.03 Rw.03 Duduan, Mekarsari,</h5>
                        <!-- <h5 class="text-center">JKutowinangun,Kebumen, Jawa Tengah 54393</h5>
                        <h5 class="text-center">No.telp : 085327033456</h5> -->
                    </div>
                </div>

                <!-- tabel untuk menampilkan isi -->
                <table class=" table  table-striped">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Update</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th style="width: 110;">Harga</th>
                        <th>Stok</th>
                    </tr>
                    <?php
                    $no = 1;
                    foreach ($barang as $br) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= date('l, d F Y', strtotime($br['updated_at'])) ?></td>
                            <td><?= $br['id_barang']; ?></td>
                            <td><?= $br['nm_barang']; ?></td>
                            <td><?= $br['nm_kategori']; ?></td>
                            <td><?= $br['satuan']; ?></td>
                            <td>Rp <?= number_format($br['harga'], '0', ',', '.'); ?></td>
                            <td>
                                <?php if ($br['stok'] <= 3) : ?>
                                    <div class="cardtext text-center text-white bg-red"><?= $br['stok']; ?></div>
                                <?php elseif ($br['stok'] >= 4 && $br['stok'] <= 10) : ?>
                                    <div class="cardtext text-center text-white bg-yellow"><?= $br['stok']; ?></div>
                                <?php else : ?>
                                    <div class="cardtext text-center text-white bg-green"><?= $br['stok']; ?></div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</main>

<script>
    window.print();
</script>

<?= $this->endSection(); ?>