<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('admin/assets/img/favicon.png') }}">
    <title>
        Klinik Dr. Marte
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('admin/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/daterangepicker.css') }}">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('admin/assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
    @stack('css')
    @livewireStyles
</head>

<body class="g-sidenav-show  bg-gray-200">
    @include('layouts.includes.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        @include('layouts.includes.navbar')

        <div class="container-fluid py-4">
            @yield('content')

            @include('layouts.includes.footer')
        </div>
    </main>
    @if (env('APP_SETTING'))
        @include('layouts.includes.setting')
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"
        integrity="sha512-yFjZbTYRCJodnuyGlsKamNE/LlEaEAxSUDe5+u61mV8zzqJVFOH7TnULE2/PP/l5vKWpUNnF4VGVkXh3MjgLsg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.min.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('js')
    <script>
        $('[data-toggle="datepicker"]').datepicker({
            format: 'YYYY-MM-DD',
        });
        // Date Range Picker
        var currentYear = moment().year(); // This Year
        var currentYearStart = moment({
            years: currentYear,
            months: '0',
            date: '1'
        }); // 1st Jan this year
        var currentYearEnd = moment({
            years: currentYear,
            months: '11',
            date: '31'
        }); // 31st Dec this year
        var start = moment().subtract(29, 'days'); // Subtract 29 days from today
        var end = moment(); // Today
        $('[data-toggle="daterangepicker"]').daterangepicker({
            ranges: {
                'Hari Ini': [moment(), moment()],
                '1 Minggu Terakhir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                'Tahun Ini': [moment(currentYearStart), moment(currentYearEnd)],
                'Tahun Lalu': [moment(currentYearStart.subtract(1, 'year')), moment(currentYearEnd.subtract(1, 'year'))],
            }
        });
        $(document).on('click', '.delete-data', function(e) {
            let ajax = $(this).data('ajax')
            e.preventDefault()
            Swal.fire({
                icon: 'error',
                title: "Apakah kamu yakin?",
                text: 'Data akan hilang selamanya',
                showCancelButton: true,
                cancelButtonColor: '#1121ee',
                confirmButtonColor: '#fe1201'
            }).then((result) => {
                if (result.isConfirmed) {
                    if (ajax) {
                        let data = $(this).parent().serialize();
                        let url = $(this).parent().attr('action')
                        $.ajax({
                            url,
                            method: 'post',
                            data,
                            success: (title) => {
                                Toast.fire({
                                    icon: 'success',
                                    title
                                })
                                table.draw()
                            }
                        })
                    } else {
                        $(this).parent().submit()
                    }
                }
            })
        })
        $('.select2').select2({
            width: '100%',
            theme: 'bootstrap'
        })
        $('input[id=search]').keyup(function(){
            if(typeof table != 'undefined'){
                table.search($(this).val()).draw()
            }
        })
    </script>
    @if (session()->has('success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: '{{ session()->get('success') }}'
            })
        </script>
    @endif
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('admin/assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
    @livewireScripts
</body>

</html>
