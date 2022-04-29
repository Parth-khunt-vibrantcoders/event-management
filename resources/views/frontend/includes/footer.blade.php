
        <!-- ARCHIVES JS -->
        <script src="{{  asset('public/frontend/js/jquery-3.5.1.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/rangeSlider.js') }}"></script>
        <script src="{{  asset('public/frontend/js/tether.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/moment.js') }}"></script>
        <script src="{{  asset('public/frontend/js/bootstrap.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/mmenu.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/mmenu.js') }}"></script>
        <script src="{{  asset('public/frontend/js/aos.js') }}"></script>
        <script src="{{  asset('public/frontend/js/aos2.js') }}"></script>
        <script src="{{  asset('public/frontend/js/slick.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/fitvids.js') }}"></script>
        <script src="{{  asset('public/frontend/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/typed.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/jquery.counterup.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/smooth-scroll.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/lightcase.js') }}"></script>
        <script src="{{  asset('public/frontend/js/search.js') }}"></script>
        <script src="{{  asset('public/frontend/js/owl.carousel.js') }}"></script>
        <script src="{{  asset('public/frontend/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/ajaxchimp.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/newsletter.js') }}"></script>
        <script src="{{  asset('public/frontend/js/jquery.form.js') }}"></script>
        <script src="{{  asset('public/frontend/js/jquery.validate.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/searched.js') }}"></script>
        <script src="{{  asset('public/frontend/js/forms-2.js') }}"></script>
        <script src="{{  asset('public/frontend/js/leaflet.js') }}"></script>
        <script src="{{  asset('public/frontend/js/leaflet-gesture-handling.min.js') }}"></script>
        <script src="{{  asset('public/frontend/js/leaflet-providers.js') }}"></script>
        <script src="{{  asset('public/frontend/js/leaflet.markercluster.js') }}"></script>
        <script src="{{  asset('public/frontend/js/map-style2.js') }}"></script>
        <script src="{{  asset('public/frontend/js/range.js') }}"></script>
        <script src="{{  asset('public/frontend/js/color-switcher.js') }}"></script>
        <script>
            $(window).on('scroll load', function() {
                $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
            });

        </script>

        <!-- Slider Revolution scripts -->
        <script src="{{  asset('public/frontend/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
        <script src="{{  asset('public/frontend/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
        <script src="{{  asset('public/frontend/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
        <script src="{{  asset('public/frontend/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
        <script src="{{  asset('public/frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
        <script src="{{  asset('public/frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
        <script src="{{  asset('public/frontend/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
        <script src="{{  asset('public/frontend/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
        <script src="{{  asset('public/frontend/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
        <script src="{{  asset('public/frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
        <script src="{{  asset('public/frontend/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
        <script>
            var typed = new Typed('.typed', {
                strings: ["Event ^2000"],
                smartBackspace: false,
                loop: true,
                showCursor: true,
                cursorChar: "|",
                typeSpeed: 50,
                backSpeed: 30,
                startDelay: 800
            });

        </script>

        <script>
            $('.slick-lancers').slick({
                infinite: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
                adaptiveHeight: true,
                responsive: [{
                    breakpoint: 1292,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false
                    }
                }, {
                    breakpoint: 993,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: true,
                        arrows: false
                    }
                }, {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: true,
                        arrows: false
                    }
                }]
            });

        </script>

        <script>
            $(".dropdown-filter").on('click', function() {

                $(".explore__form-checkbox-list").toggleClass("filter-block");

            });

        </script>

        <!-- MAIN JS -->
        <script src="{{  asset('public/frontend/js/script.js') }}"></script>

        @if (!empty($pluginjs))
        @foreach ($pluginjs as $value)
            <script src="{{ asset('public/frontend/js/'.$value) }}" type="text/javascript"></script>
        @endforeach
        @endif

        @if (!empty($js))
        @foreach ($js as $value)
            <script src="{{ asset('public/frontend/js/customjs/'.$value) }}" type="text/javascript"></script>
        @endforeach
        @endif
        <script type="text/javascript">
            jQuery(document).ready(function () {
                $('#loader').show();
                $('#loader').fadeOut(2000);
            });
        </script>

        <script>
            jQuery(document).ready(function () {
                @if (!empty($funinit))
                        @foreach ($funinit as $value)
                            {{  $value }}
                        @endforeach
                @endif
            });
        </script>
