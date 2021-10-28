<?= $this->extend('layout/templatelaporan'); ?>
<?= $this->section('content'); ?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-body">

                    <form action="/login/admin" method="POST">
                        <div class="mb-3 my-0 d-flex flex-row align-items-center justify-content-between">
                            <div class="col-6">
                                <img class="img-fluid" src="/assets/img/market.jpg" alt="">
                            </div>
                            <div class="col-6">
                                <h4 class="text-left"><b>FORM LOGIN</b></h4>

                                <!-- Menampilkan Flash data -->
                                <?php if (session()->getFlashdata('gagal')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('gagal'); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group mt-3">
                                    <label class="small mb-1" for="inputEmailAddress">Username</label>
                                    <input class="form-control " id="inputUsername" type="text" placeholder="Username" name="username" />
                                </div>
                                <div class="form-group">
                                    <label class="small mb-1" for="inputPassword">Password</label>
                                    <input class="form-control id=" inputPassword" type="password" placeholder="******" name="password" />
                                </div>
                                <div class="form-group mt-4 text-center">
                                    <button type="submit" class="btn btn-secondary btn-block"><b>Login</b> </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endsection(); ?>