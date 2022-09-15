<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="Diginorm (Tuğrul Yıldırım)" />
    <link href="{{asset("css/datatable.css")}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("css/datatable-button.css")}}">
    <link href="{{asset("css/styles.css")}}" rel="stylesheet" />
    <script src="{{asset("css/fontawesome.js")}}" crossorigin="anonymous"></script>
    @yield("head")
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{route("home")}}">DigiSafe</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Ürün ara..." aria-label="Ürün ara..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Ürünler</div>
                    <a class="nav-link" href="{{route("products.index")}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-image"></i></div>
                        Ürün listesi
                    </a>
                    <a class="nav-link" href="{{route("product-categories.index")}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-list-check"></i></div>
                        Ürün Kategorileri
                    </a>
                    <a class="nav-link" href="{{route("vendors.index")}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Tedarikçiler
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Hoşgeldiniz:</div>
                Admin
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                @yield("content")
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; DigiSafe {{date("Y")}}</div>
                    <div>
                        <a href="https://diginorm.com.tr" target="_blank">Diginorm</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="{{asset("js/bundle.js")}}" crossorigin="anonymous"></script>
<script src="{{asset("js/scripts.js")}}"></script>
<script src="{{asset("js/jquery.js")}}"></script>
<script src="{{asset("js/datatable.js")}}" crossorigin="anonymous"></script>
<script src="{{asset("js/datatable-button.js")}}"></script>
<script src="{{asset("js/jszip.min.js")}}"></script>
<script src="{{asset("js/pdfmake.min.js")}}"></script>
<script src="{{asset("js/vfs_fonts.js")}}"></script>
<script src="{{asset("js/buttons.html5.min.js")}}"></script>
<script src="{{asset("js/buttons.colVis.min.js")}}"></script>
<script src="{{asset("js/datatables-simple-demo.js")}}"></script>
<script src="{{asset("js/swal.js")}}"></script>
@yield("footer")
</body>
</html>
