<!-- NAVIGASI -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="/assets/img/logo harno@2x.png" alt="logoHarno">
    </a>

    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-secondary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item item-admin" href="#">
                    <img src="/assets/img/admin.png" alt="logo admin">
                    <br>
                    admin
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user-check"></i>
                    Activity Log</a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cog"></i>
                    Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/login">
                    <button class="btn btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </a>
            </div>
        </li>
    </ul>
</nav>