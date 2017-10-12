<template>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark scrolling-navbar">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <router-link to="/" class="navbar-brand">
                    <img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" height="30" alt="">
                </router-link>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <router-link :to="{ name: 'app.home' }" tag="li" exact class="nav-item">
                        <a class="nav-link"><i class="fa fa-home"></i> Início</a>
                    </router-link>

                    <router-link :to="{ name: 'app.contact' }" tag="li" class="nav-item">
                        <a class="nav-link"><i class="fa fa-envelope"></i> Contato</a>
                    </router-link>
                </ul>
            </div>

        </div>
    </nav>
    <!--/.Navbar-->
</template>

<script>
    export default {}
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
