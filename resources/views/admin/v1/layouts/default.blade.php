<!DOCTYPE html>
<html lang="ko">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>LunaTak Admin - @yield('pageTitle')</title>

        <!-- Custom fonts for this template-->
        <link href="{{URL::asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700&display=swap" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{URL::asset('assets/css/sb-admin-2.css')}}" rel="stylesheet">

@stack('pageIncludeCsss')

        <link href="{{URL::asset('assets/resource/lunatalk.css')}}?t={{ time() }}" rel="stylesheet">

        <script>
                var appServiceUrl = '{{ env('APP_URL') }}';
        </script>

@stack('scriptValues')

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                @include('admin.v1.includes.sidebar')

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i class="fa fa-bars"></i></button>

                        <!-- Topbar Search -->
                        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button"><i class="fas fa-search fa-sm"></i></button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a class="nav-link dropdown-toggle" href="javascript:;" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search fa-fw"></i></a>
                                <!-- Dropdown - Messages -->
                                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button"><i class="fas fa-search fa-sm"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                @include('admin.v1.includes.nav-item-alerts')
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="javascript:;" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">@yield('loginUserName')</span>
                                    <img class="img-profile rounded-circle" src="{{URL::asset('assets/img/undraw_profile.svg')}}" alt="...">
                                </a>

                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="javascript:;">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> 주문 리스트
                                    </a>

                                    <a class="dropdown-item" href="javascript:;">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> 결재 리스트
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> 로그 아웃
                                    </a>

                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @yield('pageContent')
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    @include('admin.v1.includes.footer')
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">로그아웃 하시겠습니까?.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/">로그아웃</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{URL::asset('assets/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{URL::asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{URL::asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{URL::asset('assets/js/sb-admin-2.min.js')}}"></script>

        <!-- Custom const javascript -->
        <script src="{{URL::asset('assets/resource/admin-common-script/const.js')}}?t={{ time() }}"></script>

        <!-- Custom function javascript -->
        <script src="{{URL::asset('assets/resource/admin-common-script/function.js')}}?t={{ time() }}"></script>

        <!-- Custom common javascript -->
        <script src="{{URL::asset('assets/resource/admin-common-script/common.js')}}?t={{ time() }}"></script>

@stack('pageIncludeScripts')

@if(file_exists('assets/resource/admin-pages-script/'.$pages['pageStep'].'.js'))
        <!--  pages only javascript -->
        <script src="{{URL::asset('assets/resource/admin-pages-script/'.$pages['pageStep'].'.js')}}?t={{ time() }}"></script>
@endif


@stack('pageLoadScript')

    </body>

</html>

