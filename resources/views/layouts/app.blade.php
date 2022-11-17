<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('https://s3.amazonaws.com/landing.veehive.ai/images/Background.jpeg') }}">

    <title>TAWA POS</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <link href="{{ asset('template/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('template/assets/js/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('template/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('template/assets/css/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <link href="{{ asset('template/assets/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />


    <!-- STYLES FOR POS -->
    <link href="/pos/css/vendor.min.css" rel="stylesheet" />
    <link href="/pos/css/app.min.css" rel="stylesheet" />



    <!-- BEGIN PAGE LEVEL DTATABLE STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">
    <!-- END PAGE LEVEL DTATABLE STYLES -->

</head>

<body>
    <div id="app">

         <!-- BEGIN NAVBAR  -->
        @include('layouts.main_header')
        <!--  END NAVBAR  -->

        <!--  BEGIN NAVBAR  -->
        @include('layouts.sub_header')
        <!--  END NAVBAR  -->

        <!--  BEGIN MAIN CONTAINER  -->
        <div class="main-container" id="container">

            <div class="overlay"></div>
            <div class="search-overlay"></div>

            <!--  BEGIN SIDEBAR  -->
            @include('layouts.sidebar')
            <!--  END SIDEBAR  -->

            <!--  BEGIN CONTENT AREA  -->
            @yield('content')
            <!--  END CONTENT AREA  -->

        </div>
        <!-- END MAIN CONTAINER -->
    </div>
</body>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('template/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('template/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });

        // Get the Toast button
        var toastButton = document.getElementById("toast-btn");
        // Get the Toast element
        var toastElement = document.getElementsByClassName("toast")[0];

        toastButton.onclick = function() {
            $('.toast').toast('show');
        }

    </script>

    <script src="{{ asset('template/assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('template/plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/dashboard/dash_1.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->


    <script src="{{ asset('template/assets/js/dashboard/dash_2.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <script src="{{ asset('template/assets/js/scrollspyNav.js') }}"></script>
    <!-- toastr -->
    <script src="{{ asset('template/plugins/notification/snackbar/snackbar.min.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="{{ asset('template/assets/js/components/notification/custom-snackbar.js') }}"></script>


    <!-- END GLOBAL MANDATORY STYLES -->
    <script src="{{ asset('template/assets/js/ie11fix/fn.fix-padStart.js') }}"></script>
    <script src="{{ asset('template/plugins/editors/quill/quill.js') }}"></script>
    <script src="{{ asset('template/assets/js/apps/todoList.js') }}"></script>



    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


    <!-- JAVSCRIPT FOR POS -->
    <script src="/pos/js/vendor.min.js" type="8057dc3471e8fb50485ef4cb-text/javascript"></script>
    <script src="/pos/js/app.min.js" type="8057dc3471e8fb50485ef4cb-text/javascript"></script>
    <script src="/pos/js/demo/pos-customer-order.demo.js" type="8057dc3471e8fb50485ef4cb-text/javascript"></script>
    <script src="/pos/js/rocket-loader.min.js" data-cf-settings="8057dc3471e8fb50485ef4cb-|49" defer=""></script>




    <!-- BEGIN PAGE LEVEL DATATBLE SCRIPTS -->
    <script src="{{ asset('template/plugins/table/datatable/datatables.js') }}"></script>
    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>
    <!-- END PAGE LEVEL DATATBLE SCRIPTS -->


</html>
