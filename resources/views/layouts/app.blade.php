<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" />
        <link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('assets/js/loader.js') }}"></script>

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
        <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{ asset('fonts/line-awesome/css/line-awesome.min.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.css') }}">
        <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert.css') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
        <link href="{{ asset('assets/css/tables/table-basic.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/elements/infobox.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">
        <link href="{{ asset('plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
        {{-- <link href="{{ asset('plugins/flatpickr/material_dark.css') }}" rel="stylesheet" type="text/css"> --}}
        <link href="{{ asset('assets/css/elements/color_library.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />

        <!-- SECCIÓN PARA INCLUÍR ESTILOS PERSONALIZADOS EN LOS MÓDULOS DEL SISTEMA -->
        @yield('styles')

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- NECESARIO PARA EL FUNCIONAMIENTO DE LIVEWIRE -->
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="alt-menu sidebar-noneoverflow">

        <!-- BEGIN LOADER -->
        <div id="load_screen">
            <div class="loader">
                <div class="loader-content">
                    <div class="spinner-grow align-self-center"></div>
                </div>
            </div>
        </div>
        <!-- END LOADER -->

        @include('components.header')

        <!-- BEGIN MAIN CONTAINER -->
        <div class="main-container" id="container">
            <div class="overlay"></div>
            <div class="search-overlay"></div>

            @include('components.top_bar')

            <!-- BEGIN CONTENT PART -->
            <div id="content" class="main-content">
                <div class="layout-px-spacing">
                    @yield('content')
                </div>

                <div class="ml-3 mr-3">
                    @include('components.footer')
                </div>
            </div>
            <!-- END CONTENT PART -->
        </div>
        <!-- END MAIN CONTAINER -->

        <!-- SCRIPTS GENERALES -->
        <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <script>
            $(document).ready(function() {
                App.init();

                $(".flatpickr").flatpickr({
                    enableTime: false,
                    dateFormat: "d-m-Y",
                    'locale': 'es'
                });
            });
        </script>

        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
        <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
        <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('plugins/flatpickr/flatpickr_es.js') }}"></script>

        <!-- SECCIÓN PARA INCLUÍR SCRIPTS PERSONALIZADOS EN LOS MÓDULOS DEL SISTEMA -->
        @yield('scripts')

        <!-- SCRIPTS PARA LOS MENSAJES Y NOTIFICACIONES -->
        <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

        <!-- VALIDACIONES GLOBALES DEL SISTEMA -->

        @livewireScripts
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="{{ asset('js/toast.js') }}"> </script>

        <script>
            window.livewire.on('msgok', msgOK => {
                toastr.success(msgOK, "info");
            });

            window.livewire.on('msg-error', msgError => {
                toastr.error(msgError, "error");
            });

            window.livewire.on('msg-ops', msgOK => {
                toastr.warning(msgOK, "info");
            });
        </script>

    </body>
</html>
