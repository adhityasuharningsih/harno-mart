<?= $this->extend('layout/template'); ?>


<!-- Content -->
<?= $this->section('content'); ?>


<main>
    <div class="container-fluid">
        <h3 class="mt-4">Dashboard</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <!-- Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card text-center bg-tosca text-white mb-4">
                    <div class="card-body-title">Kategori Barang
                        <div class="card-body-number"><?= count($kategori); ?></div>
                    </div>

                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="cardtext text-center bg-green text-white mb-4">
                    <div class="card-body-title">Barang Masuk
                        <div class="card-body-number"><?= count($brgmasuk); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-center bg-red text-white mb-4">
                    <div class="card-body-title">Barang Keluar
                        <div class="card-body-number"><?= count($brgkeluar); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card text-center bg-yellow text-white mb-4">
                    <div class="card-body-title">Supplier
                        <div class="card-body-number"><?= count($supplier); ?></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<?= $this->endSection(); ?>