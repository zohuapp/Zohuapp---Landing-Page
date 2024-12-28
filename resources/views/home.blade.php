@extends('app')

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            bodyTemplate = document.getElementById('body-template');
            bodyTemplate.innerHTML = '';
            database.collection('settings').doc('landingpageTemplate').get().then(async function(snapshots) {
                var html = '';
                var data = snapshots.data();
                html = data.landingpageTemplate;
                if (html != '') {
                    bodyTemplate.innerHTML = html;
                    setCarousel();
                }
            });
        });

        function setCarousel() {
            $('.owl-carousel').owlCarousel({
                items: 1,
                center: true,
                loop: true,
                nav: false,
                responsiveClass: true,
                dots: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: true,
                        loop: true,
                    },
                    600: {
                        items: 3,
                        nav: false,
                        loop: true,
                    },
                    1000: {
                        items: 4,
                        nav: true,
                        loop: true,
                        margin: 20
                    }
                }
            })
        }
    </script>
@endsection
