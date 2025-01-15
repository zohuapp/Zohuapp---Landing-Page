<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'eBasket') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('owlcarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('vendors/jquery.min.js') }}"></script>
    <script src="{{ asset('owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>


</head>

<body class="fixed-bottom-bar">

    <div id="header-template"></div>

    <main id="body-template">
        @yield('content')
    </main>

    <div id="footer-template"></div>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-storage.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
    <script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
    <script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
    <script src="{{ asset('js/crypto-js.js') }}"></script>
    <script src="{{ asset('js/jquery.cookie.js') }}"></script>
    {{-- <script src="{{ asset('js/jquery.validate.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <script type="text/javascript">
        var firebaseConfig = {
            apiKey: "{{ config('firebase.apiKey') }}",
            authDomain: "{{ config('firebase.authDomain') }}",
            databaseURL: "{{ config('firebase.databaseURL') }}",
            projectId: "{{ config('firebase.projectId') }}",
            storageBucket: "{{ config('firebase.storageBucket') }}",
            messagingSenderId: "{{ config('firebase.messagingSenderId') }}",
            appId: "{{ config('firebase.appId') }}",
            measurementId: "{{ config('firebase.measurementId') }}"
        }

        firebase.initializeApp(firebaseConfig);

        var database = firebase.firestore();

        var headerRef = database.collection('settings').doc('headerTemplate');
        var footerRef = database.collection('settings').doc('footerTemplate');

        $(document).ready(function() {

            var footer = document.getElementById('footer-template');
            footer.innerHTML = '';

            footerRef.get().then(async function(snapshots) {
                var html = '';
                var data = snapshots.data();
                html = data.footerTemplate;
                if (html != '') {
                    footer.innerHTML = html;
                }
            });

            var header = document.getElementById('header-template');
            header.innerHTML = '';

            headerRef.get().then(async function(snapshots) {
                var html = '';
                var data = snapshots.data();
                html = data.headerTemplate;
                if (html != '') {
                    header.innerHTML = html;
                }
            });

        });

        $(document.body).on('click', '.redirecttopage', function() {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        $(document.body).on('change', '#languageSelect', function(e) {
            e.preventDefault();

            let language = $('#languageSelect').val();


            $.ajax({
                type: "post",
                url: "{{ route('changeLang') }}",
                data: {
                    language: language,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        // Reload the current page to reflect the language change
                        location.reload();
                    } else {
                        console.error(response.message);
                    }
                },
                error: function(error) {
                    console.error("Error changing language:", error);
                }
            });
        });
    </script>

    @yield('scripts')

</body>

</html>
