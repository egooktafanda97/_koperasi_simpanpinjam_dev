<!DOCTYPE html>
<html lang="en">

<head>
    <title>KOPERASI</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="ego oktafanda" />
    <!-- Favicon icon -->
    <link rel="icon" href="https://bidangsampahdlhpelalawan.com/assets/img/logo/logo.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="<?= base_url("assets/admin/dist/") ?>assets/css/style.css">

    <!-- ========== -->
    <!-- Font Awesome -->
    <link href="<?= base_url('assets/admin/'); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/admin/'); ?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/admin/'); ?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.jqueryscript.net/demo/Bootstrap-4-Dropdown-Select-Plugin-jQuery/dist/css/bootstrap-select.css">
    <link href="<?= base_url('assets/admin/'); ?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/admin/'); ?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/admin/'); ?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url("assets/css/") ?>costum_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <!-- CSS Libraries -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css" />
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url("assets/css/") ?>costum_style.css">
    <style>
        #datatable-responsive_paginate {
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .pagination {
            display: flex;
            justify-content: flex-end;
        }

        .pagination .active a {
            color: #143361;
            background-color: transparent;
            font-weight: 600;
        }

        .pagination .active a:hover {
            background-color: transparent;
            color: #143361;
            border: 0px;
        }

        .pagination .active a:focus {
            background-color: transparent;
            color: #143361;
            outline: none;
        }

        .pagination li a {
            border: 1px;
            margin-left: 0px;
            color: #707070;
            padding: 7px 2px;
            margin: 0px 20px;
        }

        .pagination li a:hover {
            background-color: transparent;
            color: #4a90e2;
            padding-bottom: 2px;
            border-bottom: 1px solid;
        }

        .pagination li a:focus {
            outline: none;
            background-color: transparent;
            /*color:#707070;*/
        }

        .pagination li:first-child a,
        .pagination li:last-child a {
            border: 0px solid #143361 !important;
            border-radius: 0px;
            margin: 0px;
            padding: 6px 12px;
            border: 0px solid;
            font-size: 14px;
            color: #143361;
        }

        .pagination li:first-child a:hover,
        .pagination li:last-child a:hover {
            text-decoration: none !important;
            color: #fff;
            background-color: #143361;
        }

        .pagination li:first-child a:focus,
        .pagination li:last-child a:focus {
            outline: none;
        }
    </style>

</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <?php $this->load->view('Template/route'); ?>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">

        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="#!" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="assets/images/logo.png" alt="" class="logo">
                <img src="assets/images/logo-icon.png" alt="" class="logo-thumb">
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                    <div class="search-bar">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <ul class="pro-body">
                                <li><a href="<?= base_url("login/logout") ?>" class="dropdown-item"><i class="feather icon-lock"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>


    </header>
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <!-- <h5 class="m-b-10">Bank Sampah Pelalawan</h5> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <?php $this->load->view('/Page/' . $page); ?>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <script src="<?= base_url("assets/admin/dist/") ?>assets/js/vendor-all.min.js"></script>
    <script src="<?= base_url("assets/admin/dist/") ?>assets/js/plugins/bootstrap.min.js"></script>
    <script src="<?= base_url("assets/admin/dist/") ?>assets/js/ripple.js"></script>
    <script src="<?= base_url("assets/admin/dist/") ?>assets/js/pcoded.js"></script>

    <!-- dataTable -->

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

    <!--  -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
    <script src="<?= base_url("assets/js/") ?>costum_js.js"></script>
    <script src="https://www.jqueryscript.net/demo/Bootstrap-4-Dropdown-Select-Plugin-jQuery/dist/js/bootstrap-select.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js">
    </script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script src="<?= base_url("assets/js/costum_js.js") ?>"></script>
    <?php !empty($script) ? $this->load->view('Page/' . $script) : ""; ?>


    <!-- ======================= -->
    <!-- ======================= -->

    <!-- JS Libraies -->
    <!-- dataTable -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>


</body>

</html>