<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detached | Hyper - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ @$logoSetting->favicon }}" />

    <!-- App css -->
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="light-style" />
    <link href="{{ asset('backend/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="dark-style" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-iconpicker.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .dataTables_filter,
        .dataTables_paginate {
            float: right;
        }
    </style>
    @stack('styles')
</head>

<body class="loading" data-layout="detached"
    data-layout-config='{"layoutBoxed":false, 
    "leftSidebarCondensed":false, 
    "leftSidebarScrollable":false, 
    "darkMode":false, 
    "showRightSidebarOnStart": false}'>
    <!-- Topbar Start -->
    @include('admin.layouts.header')
    <!-- end Topbar -->

    <!-- Start Content-->
    <div class="container-fluid">
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            @include('admin.layouts.sidebar')
            <!-- Left Sidebar End -->

            <div class="content-page">
                <div class="content">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                {{-- <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">
                                            <a href="javascript: void(0);">Hyper</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="javascript: void(0);">Layout</a>
                                        </li>
                                        <li class="breadcrumb-item active">Detached</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Admin Dashboard</h4> --}}
                                <div class="row mt-3">
                                    @include('components.breadcrumb')
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            @yield('content')
                        </div>
                    </div>
                    <!-- end page title -->
                </div>
                <!-- End Content -->

                <!-- Footer Start -->
                @include('admin.layouts.footer')
                <!-- end Footer -->
            </div>
            <!-- content-page -->
        </div>
        <!-- end wrapper-->
    </div>
    <!-- END Container -->

    <!-- Right Sidebar -->
    {{-- @include('admin.layouts.setting') --}}

    <div class="rightbar-overlay"></div>
    <!-- /Right-bar -->

    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

    <!-- bundle -->
    <script src="{{ asset('backend/js/vendor.min.js') }}"></script>
    <script src="{{ asset('backend/js/app.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                @php
                    toastr()->error($error);
                @endphp
            @endforeach
        @endif
    </script>

    {{-- delete item --}}
    <script>
        $(document).ready(function() {
            $('body').on('click', '.delete-item', function(event) {
                event.preventDefault();

                let deleteUrl = $(this).attr('href');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: deleteUrl,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(data) {
                                if (data.status == 'success') {
                                    Swal.fire({
                                        icon: "success",
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 1000
                                    }).then(() => {
                                        window.location.reload();
                                    })
                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        'Cant Delete',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                });
            })
        });
    </script>
    @stack('scripts')
</body>

</html>
