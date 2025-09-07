<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggul Nusantara Sport</title>

    <!-- Favicon / title image -->
    <link rel="icon" href="{{ asset('assets/landing-page/UNSEO B.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('assets/landing-page/UNSEO B.png') }}">

    <script src="{{ asset('assets/landing-page/tailwind.css') }}"></script>
</head>

<body class="bg-white text-gray-800">

    <!-- Navbar -->
    <header class="bg-white text-red-600 shadow sticky top-0 z-30">
        <div class="max-w-7xl mx-auto flex justify-between items-center py-3 px-6">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('assets\landing-page\UNSEO B.png') }}" alt="Unggul Nusantara Sport Logo"
                    class="h-12 w-12 md:h-14 md:w-14 object-contain rounded-md">
                <div>
                    <p class="text-xl md:text-xl font-semibold">Unggul Nusantara Sport</p>
                </div>
            </div>

            <!-- Desktop nav -->
            <nav class="hidden md:flex items-center space-x-6">
                <a href="{{url('/')}}" class="hover:text-gray-200">Beranda</a>
                <a href="{{url('/')}}#fitur" class="hover:text-gray-200">Kejuaraan</a>
                <a href="{{url('/')}}#daftar" class="hover:text-gray-200">Tentang Kami</a>
                @guest
                    <a href="{{ route('login') }}" class="ml-2 bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:opacity-90">Masuk</a>
                @else
                    <a href="{{ route('dashboard') }}" class="ml-2 bg-red-600 text-white px-4 py-2 rounded-lg font-medium hover:opacity-90">Dashboard</a>
                @endguest
            </nav>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button id="navToggle" aria-label="Toggle menu" class="focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="navIcon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 8h16M4 16h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile nav (hidden by default) -->
        <div id="mobileNav" class="md:hidden hidden bg-white border-t border-red-500">
            <div class="px-6 py-4 flex flex-col space-y-3">
                <a href="{{url('/')}}" class="hover:text-gray-200">Beranda</a>
                <a href="{{url('/')}}#fitur" class="hover:text-gray-200">Kejuaraan</a>
                <a href="{{url('/')}}#daftar" class="hover:text-gray-200">Tentang Kami</a>
                @guest
                <a href="{{ route('login') }}" 
                    class="mt-2 bg-red-600 text-white px-4 py-2 rounded-lg font-medium inline-block w-max">Masuk</a>
                @else
                <a href="{{ route('dashboard') }}" 
                    class="mt-2 bg-red-600 text-white px-4 py-2 rounded-lg font-medium inline-block w-max">Dashboard</a>
                @endguest
            </div>
        </div>
    </header>
    <!-- End Navbar -->

    {{ $slot }}

    <script>
        (function() {
            const btn = document.getElementById('navToggle');
            const nav = document.getElementById('mobileNav');
            btn && btn.addEventListener('click', function() {
                nav.classList.toggle('hidden');
            });
        })();

        (function() {
            const track = document.getElementById('partnersTrack');
            const prev = document.getElementById('partnersPrev');
            const next = document.getElementById('partnersNext');
            const dotsContainer = document.getElementById('partnersDots');
            const slides = track.children;
            const total = slides.length;
            let index = 0;
            let autoplayTimer = null;
            const AUTOPLAY_DELAY = 4000;

            function goTo(i) {
                index = (i + total) % total;
                track.style.transform = `translateX(-${index * 100}%)`;
                updateDots();
            }

            function nextSlide() {
                goTo(index + 1);
            }

            function prevSlide() {
                goTo(index - 1);
            }

            // build dots
            for (let i = 0; i < total; i++) {
                const btn = document.createElement('button');
                btn.className = 'w-3 h-3 rounded-full bg-gray-300';
                btn.setAttribute('aria-label', 'Slide ' + (i + 1));
                btn.addEventListener('click', () => {
                    goTo(i);
                    resetAutoplay();
                });
                dotsContainer.appendChild(btn);
            }

            function updateDots() {
                Array.from(dotsContainer.children).forEach((d, idx) => {
                    d.classList.toggle('bg-red-600', idx === index);
                    d.classList.toggle('bg-gray-300', idx !== index);
                });
            }

            prev.addEventListener('click', () => {
                prevSlide();
                resetAutoplay();
            });
            next.addEventListener('click', () => {
                nextSlide();
                resetAutoplay();
            });

            function startAutoplay() {
                stopAutoplay();
                autoplayTimer = setInterval(nextSlide, AUTOPLAY_DELAY);
            }

            function stopAutoplay() {
                if (autoplayTimer) {
                    clearInterval(autoplayTimer);
                    autoplayTimer = null;
                }
            }

            function resetAutoplay() {
                startAutoplay();
            }

            // init
            goTo(0);
            startAutoplay();

            // pause on hover to allow interaction
            track.parentElement.addEventListener('mouseenter', stopAutoplay);
            track.parentElement.addEventListener('mouseleave', startAutoplay);

            // enable swipe for touch devices
            let startX = 0,
                endX = 0;
            track.parentElement.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                stopAutoplay();
            });
            track.parentElement.addEventListener('touchmove', (e) => {
                endX = e.touches[0].clientX;
            });
            track.parentElement.addEventListener('touchend', () => {
                const diff = endX - startX;
                if (Math.abs(diff) > 40) {
                    if (diff < 0) nextSlide();
                    else prevSlide();
                }
                resetAutoplay();
            });
        })();
    </script>
    <!-- Footer -->
    <footer class="bg-red-600 text-white py-8">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
            <p>&copy; 2025 Unggul Nusantara Sport. Semua Hak Dilindungi.</p>
            <div class="space-x-4 mt-4 md:mt-0">
                <a href="#" class="hover:text-gray-200">Kebijakan Privasi</a>
                <a href="#" class="hover:text-gray-200">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>

</body>

</html>
