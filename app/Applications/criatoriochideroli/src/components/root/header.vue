<template>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark scrolling-navbar">
        <div class="container">

            <a class="navbar-brand" href="#">
                <img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" height="30" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"><i class="fa fa-envelope"></i> Contact <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa fa-gear"></i> Settings</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Profile </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
                            <a class="dropdown-item" href="#">My account</a>
                            <a class="dropdown-item" href="#">Log out</a>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <!--/.Navbar-->
</template>

<script>
export default {

}
</script><!-- Template styles -->

<style>
    /* TEMPLATE STYLES */
    main {
        padding-top: 3rem;
        padding-bottom: 2rem;
    }

    .widget-wrapper {
        padding-bottom: 2rem;
        border-bottom: 1px solid #e0e0e0;
        margin-bottom: 2rem;
    }

    .extra-margins {
        margin-top: 1rem;
        margin-bottom: 2.5rem;
    }

    .divider-new {
        margin-top: 0;
    }

    .navbar {
        background-color: #414a5c;
    }

    footer.page-footer {
        background-color: #414a5c;
        margin-top: 2rem;
    }

    .list-group-item.active {
        background-color: #2bbbad;
        border-color: #2bbbad
    }

    .list-group-item:not(.active) {
        color: #222;
    }

    .list-group-item:not(.active):hover {
        color: #666;
    }
    .card {
        font-weight: 300;
    }
    .navbar .btn-group .dropdown-menu a:hover {
        color: #000 !important;
    }
    .navbar .btn-group .dropdown-menu a:active {
        color: #fff !important;
    }
</style>
